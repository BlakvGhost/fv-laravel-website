<div class="my-3 border-top" style="font-size:22px">
        <form method="POST" class="py-4">
            <div class="fv-title-normal fvSlideOn my-3">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Ecrivez-Nous Directement par ici </h3>
            </div>
            {{-- <div class="alert alert-dismissible alert-danger" role="alert" id="liveAlert" v-show="error">
                <div class="msg-alert"> {{ error }} </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-dismissible alert-success" role="alert" id="liveAlertSuccess" v-show="success">
                <div class="msg-alert text-center"> 
                    <h3> {{ first_name + " " + last_name }} votre message a bien été envoyé !</h3>                    
                </div>
            </div> --}}
            <div>
                <div class="row row-col-2 my-3 fv-f-direc-col-sm">
                    <div class="form-group col">
                        <label for="yourName" class="form-text">Nom* : </label>
                        <input type="text" name="name" id="yourFirstName" placeholder="Entrer votre Nom" class="form-control" v-model="last_name">
                    </div>
                    <div class="form-group col">
                        <label for="yourLastName" class="form-text">Prenom* : </label>
                        <input type="text" name="surname" id="yourLastName" placeholder="Entrer votre Prenom" class="form-control" v-model="first_name">
                    </div>
                </div>
                <div class="form-group my-2">
                    <label for="youremail" class="form-text">Email* : </label>
                    <input type="email" name="email" id="youremail" placeholder="Entrer votre Email pour etre repondu" class="form-control" v-model="email">
                </div>
                <div class="form-group">
                    <label for="message" class="form-text">Message* : </label>
                    <textarea name="message" id="message" placeholder="Entrer votre Message" class="form-control" cols="40" rows="8" v-model="message"></textarea>
                </div>
                <div class="text-center my-2">
                    <button type="submit" class="btn btn-success fv-w-50-lg fv-w-75-sm m-auto">ENVOYER</button>
                </div>
            </div>
        </form>
</div>
