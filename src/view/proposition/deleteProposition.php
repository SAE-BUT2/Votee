<div class="flex flex-col justify-center items-center gap-7">
    <h1>Cette action supprimera définitivement la proposition</h1>
    <div class="flex items-center gap-7">
        <a class="p-2 w-48 text-center text-white bg-main font-semibold rounded-lg"
           href="./frontController.php?controller=proposition&action=deletedProposition&idQuestion=<?= rawurldecode($idQuestion) ?>&idProposition=<?= rawurldecode($idProposition) ?>">Oui</a>
        <a class="p-2 w-48 text-center text-white bg-main font-semibold rounded-lg"
           href="./frontController.php?controller=question&action=all">Non</a>
    </div>
</div>