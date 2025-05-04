<div class="d-flex">
    <div class="ms-auto">
        @if ($hasExcel)
            <a class="btn btn-primary btn-round me-1" href="{{ route('datatables.excel', ['class' => $class]) }}" data-tippy-content="{{ __('facades.datatables.to_excel') }}">
                <i class="bi bi-filetype-xlsx"></i>
            </a>
        @endif
        @if ($hasCsv)
            <a class="btn btn-primary btn-round me-1" href="{{ route('datatables.excel', ['class' => $class]) }}" data-tippy-content="{{ __('facades.datatables.to_csv') }}">
                <i class="bi bi-filetype-csv"></i>
            </a>
        @endif
        @if ($hasColumns)
            <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#columnsModal_{{ $datatable_id }}" data-tippy-content="{{ __('facades.datatables.select_columns') }}">
                <i class="bi bi-person-lines-fill"></i>
            </button>
        @endif
    </div>

</div>
@if($hasColumns)
    <div class="modal fade" id="columnsModal_{{ $datatable_id }}" tabindex="-1" aria-labelledby="columnsModal_{{ $datatable_id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('datatables.save_columns') }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <input type="hidden" name="datatable_id" value="{{ $datatable_id }}"/>
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="columnsModal_{{ $datatable_id }}Label">{{ __('facades.datatables.select_columns') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('buttons.close') }}"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table draggable-table" id="select_columns_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($columns as $key => $column)
                                    <tr>
                                        <input type="hidden" name="columns[]" value="{{ $key }}">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input columns-check" type="checkbox" name="selected[]" value="{{ $key }}" id="{{ $key }}_check"{{ in_array($key, $selected) ? ' checked':'' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="bi bi-three-dots-vertical me-1 text-muted"></i><span>{{ $column->title }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" id="columnsModalDismiss" data-bs-dismiss="modal">{{ __('buttons.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('buttons.save') }}</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endif

@push('custom-scripts')
    @if($hasColumns)
        <script type="text/javascript">
            (function() {
                "use strict";

                const table = document.getElementById('select_columns_table');
                const tbody = table.querySelector('tbody');

                var currRow = null,
                    dragElem = null,
                    mouseDownX = 0,
                    mouseDownY = 0,
                    mouseX = 0,
                    mouseY = 0,
                    mouseDrag = false;

                function init() {
                    bindMouse();
                }

                function bindMouse() {
                    document.addEventListener('mousedown', (event) => {
                    if(event.button != 0) return true;

                    let target = getTargetRow(event.target);
                    if(target) {
                        currRow = target;
                        addDraggableRow(target);
                        currRow.classList.add('is-dragging');


                        let coords = getMouseCoords(event);
                        mouseDownX = coords.x;
                        mouseDownY = coords.y;

                        mouseDrag = true;
                    }
                    });

                    document.addEventListener('mousemove', (event) => {
                    if(!mouseDrag) return;

                    let coords = getMouseCoords(event);
                    mouseX = coords.x - mouseDownX;
                    mouseY = coords.y - mouseDownY;

                    moveRow(mouseX, mouseY);
                    });

                    document.addEventListener('mouseup', (event) => {
                    if(!mouseDrag) return;

                    currRow.classList.remove('is-dragging');
                    table.removeChild(dragElem);

                    dragElem = null;
                    mouseDrag = false;
                    });
                }


                function swapRow(row, index) {
                    let currIndex = Array.from(tbody.children).indexOf(currRow),
                        row1 = currIndex > index ? currRow : row,
                        row2 = currIndex > index ? row : currRow;

                    tbody.insertBefore(row1, row2);
                }

                function moveRow(x, y) {
                    dragElem.style.transform = "translate3d(" + x + "px, " + y + "px, 0)";

                    let	dPos = dragElem.getBoundingClientRect(),
                        currStartY = dPos.y, currEndY = currStartY + dPos.height,
                        rows = getRows();

                    for(var i = 0; i < rows.length; i++) {
                    let rowElem = rows[i],
                        rowSize = rowElem.getBoundingClientRect(),
                        rowStartY = rowSize.y, rowEndY = rowStartY + rowSize.height;

                    if(currRow !== rowElem && isIntersecting(currStartY, currEndY, rowStartY, rowEndY)) {
                        if(Math.abs(currStartY - rowStartY) < rowSize.height / 2)
                        swapRow(rowElem, i);
                    }
                    }
                }

                function addDraggableRow(target) {
                    dragElem = target.cloneNode(true);
                    dragElem.classList.add('draggable-table__drag');
                    dragElem.style.height = getStyle(target, 'height');
                    dragElem.style.background = getStyle(target, 'backgroundColor');
                    for(var i = 0; i < target.children.length; i++) {
                        let oldTD = target.children[i],
                            newTD = dragElem.children[i];
                        newTD.style.width = getStyle(oldTD, 'width');
                        newTD.style.height = getStyle(oldTD, 'height');
                        newTD.style.padding = getStyle(oldTD, 'padding');
                        newTD.style.margin = getStyle(oldTD, 'margin');
                    }

                    table.appendChild(dragElem);


                    let tPos = target.getBoundingClientRect(),
                        dPos = dragElem.getBoundingClientRect();
                    dragElem.style.bottom = ((dPos.y - tPos.y) - tPos.height) + "px";
                    dragElem.style.left = "-1px";

                    document.dispatchEvent(new MouseEvent('mousemove',
                        { view: window, cancelable: true, bubbles: true }
                    ));
                }


                function getRows() {
                    return table.querySelectorAll('tbody tr');
                }

                function getTargetRow(target) {
                    let elemName = target.tagName.toLowerCase();

                    if(elemName == 'tr') return target;
                    if(elemName == 'td') return target.closest('tr');
                }

                function getMouseCoords(event) {
                    return {
                        x: event.clientX,
                        y: event.clientY
                    };
                }

                function getStyle(target, styleName) {
                    let compStyle = getComputedStyle(target),
                        style = compStyle[styleName];

                    return style ? style : null;
                }

                function isIntersecting(min0, max0, min1, max1) {
                    return Math.max(min0, max0) >= Math.min(min1, max1) &&
                            Math.min(min0, max0) <= Math.max(min1, max1);
                }



                init();

            })();
        </script>
    @endif
@endpush
