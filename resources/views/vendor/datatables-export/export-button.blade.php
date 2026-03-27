<div class="d-flex align-items-center" x-data>
    <form class="mr-2"
          x-on:submit.prevent="
                $refs.exportBtn.disabled = true;
                var url = window._buildUrl(LaravelDataTables['{{ $tableId }}'], 'exportQueue');
                $.get(url + '&exportType={{$fileType}}&sheetName={{$sheetName}}&emailTo={{urlencode($emailTo)}}').then(function(exportId) {
                    $wire.export(exportId)
                }).catch(function(error) {
                    $wire.exportFinished = true;
                    $wire.exporting = false;
                    $wire.exportFailed = true;
                });
              "
    >
        <button type="submit"
                x-ref="exportBtn"
                :disabled="$wire.exporting"
                class="{{ $class }}"
        >{{ __('globals.datatables_export.button') }}
        </button>
    </form>

    @if($exporting && $emailTo)
        <div class="d-inline">{{ __('globals.datatables_export.email_notice', ['email' => $emailTo]) }}</div>
    @endif

    @if($exporting && !$exportFinished)
        <div class="d-inline" wire:poll="updateExportProgress">{{ __('globals.datatables_export.in_progress') }}</div>
    @endif

    @if($exportFinished && !$exportFailed && !$autoDownload)
        <span>{{ __('globals.datatables_export.done_download') }} <a href="#" class="text-primary" wire:click.prevent="downloadExport">{{ __('globals.here') }}</a></span>
    @endif

    @if($exportFinished && !$exportFailed && $autoDownload && $downloaded)
        <span>{{ __('globals.datatables_export.done_downloaded') }}</span>
    @endif

    @if($exportFailed)
        <span>{{ __('globals.datatables_export.failed') }}</span>
    @endif
</div>
