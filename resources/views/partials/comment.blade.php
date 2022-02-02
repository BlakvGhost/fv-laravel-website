<div class="my-3 border-top" style="font-size:22px">
    <div class="fv-title-normal fvSlideOn my-3">
        <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Reaction au Poste </h3>
    </div>
    <div class="my-2">
        <x-react-post :post="$post"></x-react-post>
    </div>
    <div class="my-3">
        @auth
            <form method="POST" class="py-2" action="">
                @csrf
                @if( $errors->any())
                    <div class="alert alert-dismissible alert-danger" role="alert" id="liveAlert">
                        <div class="msg-alert">
                            @foreach($errors->all() as $error)
                                <small>{{ $error }}</small> <br>
                            @endforeach
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if( session('status'))
                    <div class="alert alert-dismissible alert-success" role="alert" id="OkliveAlert">
                        <div class="msg-alert">
                            <small> {{ session('status')}} </small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <label for="editor" class="form-text">Commentaire* : </label>
                    <textarea name="content" id="editor" placeholder="Entrer votre Message" class="form-control" cols="40" rows="5"></textarea>
                </div>
                <div class="text-center my-2">
                    <button type="submit" class="btn btn-success w-50 m-auto">Commenter</button>
                </div>
            </form>
        @else
            <div class="alert alert-dismissible alert-warning" role="alert" id="liveAlertWarn">
                <div class="msg-alert text-center">
                    <h3> Connectez-Vous avant d'effectuer des commentaires sur cette Publication</h3>
                    <a style="font-size:22px" href="{{ route('login') }}" class="btn btn-link">Connexion</a>
                    <a style="font-size:22px" href="{{ route('register') }}" class="btn btn-link">Creation de Compte</a>
                </div>
            </div>
        @endauth
    </div>
    <div class="my-2 row justify-content-between">
        @forelse ($post->comments as $comment)
            <div class="card m-2 p-2 fvSlideOn col col-5">
                <div class="card-header bg-transparent row border-0">
                    {{-- <div class="text-white col col-auto">
                        <img src="{{ $comment->user->avatar ? Storage::url($comment->user->avatar): '/logo.jpg' }}" class="rounded-circle img-trumbnail" style="width:72px;height:72px;">
                    </div> --}}
                    <div class="col text-dark align-self-center">
                        <div class="fv-title-big">
                            {{-- <h6 class="fw-bolder oswald-bold"> {{ $comment->user->first_name . ' ' . $comment->user->last_name }} </h6> --}}
                        </div>
                        <div class="fv-title-normal">
                            <h6 class="text-fv-primary"> {{ Carbon\Carbon::now()->diffForHumans($comment->created_at) }} </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="fv-title-normal fvSlideOn">
                        <h6 class="text-dark"  style="font-size:22px">
                            {!! $comment->content !!}
                        </h6>
                    </div>
                </div>
            </div>
        @empty
            <h3>Pas de Commentaire pour ce Post</h3>
        @endforelse
        {{-- <div class="my-3 text-center w-100" v-if="comments.count >= 5">
            <ul class="pagination w-50 mx-auto">
                <li class="page-item previous" :class="!comments.previous ? 'disabled' : null" @click="comments.previous ? paginateTo(comments.previous, --page): null">
                    <a href="javascript:void(0)" class="page-link">Precedent</a>
                </li>
                <li class="page-item" v-for="u in Math.ceil(comments.count / 5)" :key="u" @click="paginate(u)" :class="u === page ? 'active' : 'inactive'">
                    <a href="javascript:void(0)" class="page-link"> {{ u }} </a>
                </li>
                <li class="page-item next" :class="!comments.next ? 'disabled' : null" @click="comments.next ? paginateTo(comments.next, ++page): null">
                    <a href="javascript:void(0)" class="page-link">Suivant</a>
                </li>
            </ul>
        </div> --}}
    </div>
</div>