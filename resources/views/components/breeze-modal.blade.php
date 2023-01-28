<div>
    @props([
    'id',
    'model',
    'maxWidth' => '2xl',
    ])
    <div {{ $attributes->merge(['class' => 'modal fade']) }} id="{{$id}}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$title}}</h5> <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{$body}}
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close
                    </button> 
                    <button wire:click="{{$model}}" type="button" class="btn btn-primary">Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>