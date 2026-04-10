<?php

namespace App\Enums\Mbo;

use App\Support\Concerns\EnumHasValues;

enum CampaignStage: string
{
    use EnumHasValues;

    case DEFINITION = 'definition';

    case DISPOSITION = 'disposition';

    case REALIZATION = 'realization';

    case EVALUATION = 'evaluation';

    case SELF_EVALUATION = 'self_evaluation';

    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case TERMINATED = 'terminated';
    case CANCELED = 'canceled';

    public static function hardValues(): array
    {
        return [
            self::PENDING->value,
            self::IN_PROGRESS->value,
            self::COMPLETED->value,
            self::TERMINATED->value,
            self::CANCELED->value,
        ];
    }

    public static function softValues(): array
    {
        return [
            self::DEFINITION->value,
            self::DISPOSITION->value,
            self::REALIZATION->value,
            self::EVALUATION->value,
            self::SELF_EVALUATION->value,
        ];
    }

    public static function sequences(): array
    {
        return [
            self::PENDING->value => 0,
            self::DEFINITION->value => 1,
            self::DISPOSITION->value => 2,
            self::REALIZATION->value => 3,
            self::EVALUATION->value => 4,
            self::SELF_EVALUATION->value => 5,
            self::COMPLETED->value => 6,
        ];
    }

    public static function hardValuesOrder(): array
    {
        return [
            self::IN_PROGRESS->value,
            self::PENDING->value,
            self::COMPLETED->value,
            self::TERMINATED->value,
            self::CANCELED->value,
        ];
    }

    public static function getName(self|string $value): string
    {
        $stage = self::resolve($value);

        return $stage?->label() ?? (is_string($value) ? $value : $value->value);
    }

    public static function getInfo(self|string $value): string
    {
        $stage = self::resolve($value);

        return $stage?->info() ?? __('forms.campaigns.info.' . (is_string($value) ? $value : $value->value));
    }

    public static function getBySequence(int $sequence): ?string
    {
        $stages = self::sequences();

        foreach ($stages as $key => $value) {
            if ($value === $sequence) {
                return $key;
            }
        }

        return null;
    }

    public static function stageIcon(self|string $stage): string
    {
        return match (self::resolve($stage)) {
            self::PENDING => 'bi-hourglass',
            self::DEFINITION, self::DISPOSITION => 'bi-hourglass-top',
            self::REALIZATION, self::EVALUATION, self::SELF_EVALUATION => 'bi-hourglass-split',
            self::TERMINATED => 'bi-pause-circle-fill',
            self::CANCELED => 'bi-x-circle-fill',
            default => 'bi-hourglass-bottom',
        };
    }

    /**
     * @param string $stage - UserCampaign stage
     * @param string|null $status - UserObjective status
     * @return string $status
     */
    public static function mapObjectiveStatus(self|string $stage, ?string $status): ?string
    {
        $stage = self::resolve($stage);
        if (is_null($stage)) {
            return $status;
        }

        $sequences = self::sequences();
        $frozen = UserObjectiveStatus::evaluated();
        $stageValue = $stage->value;

        if (array_key_exists($stageValue, $sequences) && ! in_array($status, $frozen, true)) {
            if (in_array($stage, [self::REALIZATION, self::IN_PROGRESS], true)) {
                $status = UserObjectiveStatus::PROGRESS->value;
            } elseif ($sequences[$stageValue] < $sequences[self::REALIZATION->value]) {
                $status = UserObjectiveStatus::UNSTARTED->value;
            } elseif ($sequences[$stageValue] > $sequences[self::REALIZATION->value]) {
                $status = UserObjectiveStatus::COMPLETED->value;
            }
        }

        return $status;
    }

    public static function fromto_labels(): array
    {
        $arr = [];

        foreach (self::labels() as $key => $value) {
            $arr[$key . '_from'] = $value . ' ' . __('forms.from');
            $arr[$key . '_to'] = $value . ' ' . __('forms.to');
        }

        return $arr;
    }

    public function label(): string
    {
        return __('forms.campaigns.stages.' . $this->value);
    }

    public function info(): string
    {
        return __('forms.campaigns.info.' . $this->value);
    }

    private static function resolve(self|string $stage): ?self
    {
        if ($stage instanceof self) {
            return $stage;
        }

        return self::tryFrom($stage);
    }
}
