<form class="flex flex-col gap-10" method="post" action="frontController.php?controller=question&action=addedResp">
    <h1 class="title text-dark text-2xl font-semibold">Responsables</h1>
    <div class="flex flex-wrap gap-2 justify-center">
        <?php
        foreach ($responsables as $key=>$responsable) {
            echo '<div class="border-2 border-transparent util-box text-main items-center bg-white shadow-md rounded-2xl w-fit p-2">
                        <input class="votantCheck" type="checkbox" name="votants[]" id="votant' . $key . '" value="' . $responsable->getLogin() . '" checked/>
                        <label class="cursor-pointer flex gap-1 items-center" for="votant' . $key . '"><span class="material-symbols-outlined">account_circle</span>' . $responsable->getPrenom() . ' ' . $responsable->getNom() . '</label>
                      </div>';
        }

        foreach ($utilisateurs as $key=>$utilisateur) {
            echo '<div class="border-2 border-transparent util-box text-main items-center bg-white shadow-md rounded-2xl w-fit p-2">
                        <input class="utilCheck" type="checkbox" name="utilisateurs[]" id="util' . $key . '" value="' . $utilisateur->getLogin() . '"/>
                        <label class="cursor-pointer flex gap-1 items-center" for="util' . $key . '"><span class="material-symbols-outlined">account_circle</span>' . $utilisateur->getPrenom() . ' ' . $utilisateur->getNom() . '</label>
                      </div>';
        }
        ?>
    </div>

    <div class="flex justify-center">
        <input type="hidden" name="idQuestion" value="<?= $idQuestion ?>"/>
        <input type="hidden" name="type" value="update"/>
        <input class="w-36 p-2 text-white bg-main font-semibold rounded-lg" type="submit" value="Valider" />
    </div>
</form>