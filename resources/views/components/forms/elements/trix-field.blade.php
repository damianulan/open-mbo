@props(['id', 'name', 'toolbar', 'value' => ''])

<input
    type="hidden"
    name="{{ $name }}"
    id="{{ $id }}"
    value="{{ $value }}"
/>
<trix-toolbar id="trix-toolbar-short">
    <div class="trix-button-row">
        <button type="button" 
        class="btn btn-outline-secondary trix-btn trix-button--icon-bold"
        data-trix-attribute="bold" 
        data-trix-key="b"
        tabindex="-1" 
        title="Pogrubienie"
        ><i class="bi-type-bold"></i></button>
    
        <button type="button" 
        class="btn btn-outline-secondary trix-btn trix-button--icon-italic"
        data-trix-attribute="italic" 
        data-trix-key="i"
        tabindex="-1" 
        title="Pochyła"
        ><i class="bi-type-italic"></i></button>
        
        <button type="button" 
        class="btn btn-outline-secondary trix-btn trix-button--icon-link"
        data-trix-attribute="href"
        data-trix-action="link" 
        data-trix-key="k"
        tabindex="-1" 
        title="Hiperłącze"
        ><i class="bi-link-45deg"></i></button>
        
        <button type="button" 
        class="btn btn-outline-secondary trix-btn trix-button--icon-quote ms-2"
        data-trix-attribute="quote" 
        tabindex="-1" 
        title="Cytat"
        ><i class="bi-quote"></i></button>
        
        <button type="button" 
        class="btn btn-outline-secondary trix-btn trix-button--icon-bullet-list"
        data-trix-attribute="bullet" 
        tabindex="-1" 
        title="Lista punktowana"
        ><i class="bi-list-ul"></i></button>
        
        <button type="button" 
        class="btn btn-outline-secondary trix-btn trix-button--icon-number-list"
        data-trix-attribute="number" 
        tabindex="-1" 
        title="Lista numeryczna"
        ><i class="bi-list-ol"></i></button>
    </div>
    <div class="trix-dialogs" data-trix-dialogs="">
        <div class="trix-dialog trix-dialog--link" data-trix-dialog="href" data-trix-dialog-attribute="href">
          <div class="trix-dialog__link-fields">
            <input type="url" name="href" class="form-control trix-input trix-input--dialog" placeholder="Wprowadź adres" aria-label="URL" required="" data-trix-input="" disabled="disabled">
            <div class="trix-button-group">
              <input type="button" class="btn trix-button trix-button--dialog" value="Link" data-trix-method="setAttribute">
              <input type="button" class="btn trix-button trix-button--dialog" value="Unlink" data-trix-method="removeAttribute">
            </div>
          </div>
        </div>
    </div>
    
</trix-toolbar>
<trix-editor
    id="{{ $id }}"
    input="{{ $id }}" 
    toolbar="trix-toolbar-{{ $toolbar }}"
    {{ $attributes->merge(['class' => 'trix-content form-control']) }}
></trix-editor>
