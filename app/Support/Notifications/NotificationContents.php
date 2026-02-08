<?php

namespace App\Support\Notifications;

use Exception;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

class NotificationContents implements CastsAttributes, Jsonable
{
    public $system_contents;

    public $email_contents;

    public $subject;

    public static function boot(?string $system_contents = null, ?string $email_contents = null, ?string $subject = null): self
    {
        $instance = new self();
        $instance->system_contents = $system_contents;
        $instance->email_contents = $email_contents;
        $instance->subject = $subject;

        return $instance;
    }

    public static function system(string $contents): self
    {
        return self::boot($contents, null, null);
    }

    public static function email(string $contents, string $subject): self
    {
        return self::boot(null, $contents, $subject);
    }

    public function setSystemContents(string $contents): self
    {
        $this->system_contents = $contents;

        return $this;
    }

    public function setEmailContents(string $contents, string $subject): self
    {
        $this->email_contents = $contents;
        $this->subject = $subject;

        return $this;
    }

    public function fill(array $placeholders): self
    {
        if ( ! empty($this->system_contents)) {
            $this->system_contents = $this->replacePlaceholders($this->system_contents, $placeholders);
        }
        if ( ! empty($this->email_contents)) {
            $this->email_contents = $this->replacePlaceholders($this->email_contents, $placeholders);
        }
        if ( ! empty($this->subject)) {
            $this->subject = $this->replacePlaceholders($this->subject, $placeholders);
        }

        return $this;
    }

    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        try {
            $json = json_decode($value, true);

            if ($json) {
                return static::boot($json['system_contents'], $json['email_contents'], $json['subject']);
            }
        } catch (Exception $th) {
            report($th);
        }

        return null;
    }

    public function toJson($options = 0)
    {
        if ( ! $options) {
            $options = JSON_UNESCAPED_UNICODE;
        }

        return json_encode([
            'system_contents' => $this->system_contents,
            'email_contents' => $this->email_contents,
            'subject' => $this->subject,
        ], $options);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        try {
            if ($value instanceof self) {
                return $value->toJson();
            }

            return json_encode($value);
        } catch (Exception $th) {
            report($th);
        }

        return null;
    }

    private function replacePlaceholders(string $text, array $arr)
    {
        // Use regex to find all occurrences of {% key %}
        return preg_replace_callback('/{%\s*(\w+)\s*%}/', function ($matches) use ($arr) {
            $key = $matches[1];

            // Replace with corresponding value if it exists, otherwise leave unchanged
            return $arr[$key] ?? $matches[0];
        }, $text);
    }
}
