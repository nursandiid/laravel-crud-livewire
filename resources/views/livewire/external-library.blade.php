<div>
    <div class="mb-3">
        <label for="datepicker">Datepicker</label>
        <input type="text" id="datepicker" class="form-control input-datepicker w-auto">
    </div>

    <div class="mb-3">
        <label for="autocomplete">Autocomplete</label>
        <input type="text" class="form-control w-50 search" 
            placeholder="Type to search..."
            wire:model="search">
        
            @push('css')
                <style>
                    .autocomplete .list-unstyled {
                        border-radius: 0 0 0.25rem 0.25rem;
                        border: 1px solid #ced4da;
                        border-top: 0;
                        overflow: hidden;
                        margin-top: -5px;
                        padding-top: 5px;
                    }
                    .autocomplete li {
                        padding: 5px 10px;
                        transition: .3s;
                    }
                    .autocomplete li:hover {
                        background: #f0f0f0;
                    }
                </style>
            @endpush
        <div class="w-50 autocomplete">
            <ul class="list-unstyled">
            @foreach ($searchbox as $key => $value)
                <li><a href="javascript:void(0)" class="text-dark text-decoration-none">{{ $value }}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('.input-datepicker').datepicker({
                clearBtn: true,
                format: "yyyy-mm-dd",
                autoclose: true,
            });

            $('.autocomplete').hide();
            $(document).on('keydown', '.search', function (e) {
                $('.autocomplete').show();

                if (e.keyCode == 27 || $(this).val() == '') {
                    $('.autocomplete').hide();
                }
            });
            
        })
    </script>
@endpush