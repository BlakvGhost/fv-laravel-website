<div>
    <a href="javascript:void(0)" @class(['btn btn-light react', 'text-danger' => $liked]) id="lk_btn">
        <i @class(['mdi', 'mdi-thumb-up' => $liked, 'mdi-thumb-up-outline' => !$liked])></i>
        <span> {{ $post->likes->filter(fn ($value, $key) => $value->type == 'like')->count() }} </span>
    </a>
    <a href="javascript:void(0)" @class(['btn btn-light react', 'text-danger' => $unLiked]) id="1lk_btn">
        <i @class(['mdi', 'mdi-thumb-down' => $liked, 'mdi-thumb-down-outline' => !$liked])></i>
        <span> {{ $post->likes->filter(fn ($value, $key) => $value->type == 'unlike')->count() }} </span>
    </a>
    <a href="#postComment" @class(['btn btn-light disabled', 'text-danger' => $commented])>
        <i class="mdi mdi-android-messages"></i>
        <span> {{ $post->comments->count() }} </span>
    </a>
    <a href="javascript:void(0)" @class(['btn btn-light disabled', 'text-danger' => $viewed])>
        <i class="mdi mdi-eye-outline"></i>
        <span> {{ $post->viewers->count() }} </span>
    </a>
</div>

@section('script')
    <script type="text/javascript" charset="utf-8">
        $(document).ready( function() {
            $('.react').each((elt, key) => {
                $(elt).click( (e) => {
                    
                });
            })
        })
    </script>
@endsection