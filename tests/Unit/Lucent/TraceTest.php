<?php

namespace Tests\Unit\Lucent;

use Lucent\Support\Trace;
use ReflectionMethod;
use RuntimeException;
use Tests\TestCase;

class TraceTest extends TestCase
{
    public function test_it_resolves_the_caller_and_reflection_details(): void
    {
        $trace = $this->captureTrace();

        $caller = $trace->caller();

        $this->assertNotNull($caller);
        $this->assertSame(self::class, $caller['class']);
        $this->assertSame('captureTrace', $caller['function']);

        $reflection = Trace::reflectionForFrame($caller);

        $this->assertInstanceOf(ReflectionMethod::class, $reflection);
        $this->assertSame('captureTrace', $reflection->getName());

        $details = $trace->details();

        $this->assertSame(self::class, $details[1]['class']);
        $this->assertSame('captureTrace', $details[1]['function']);
        $this->assertStringContainsString('captureTrace', $details[1]['signature']);
    }

    public function test_it_can_filter_application_frames_and_build_step_descriptions(): void
    {
        $trace = $this->captureTrace()->onlyApplicationFrames();

        $this->assertGreaterThan(0, $trace->count());

        foreach ($trace->all() as $frame) {
            $this->assertStringStartsWith(base_path(), $frame['file']);
        }

        $steps = $trace->steps(withSignature: true);

        $this->assertNotEmpty($steps);
        $this->assertStringContainsString('captureTrace', implode("\n", $steps));
    }

    public function test_it_can_boot_from_a_throwable_trace(): void
    {
        try {
            $this->throwTraceException();
        } catch (RuntimeException $exception) {
            $trace = Trace::fromThrowable($exception);
        }

        $this->assertInstanceOf(Trace::class, $trace);
        $this->assertSame('throwTraceException', $trace->first()['function']);
    }

    protected function captureTrace(): Trace
    {
        return Trace::boot();
    }

    protected function throwTraceException(): never
    {
        throw new RuntimeException('Trace me');
    }
}
