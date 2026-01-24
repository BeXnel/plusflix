<?php
/** @var \App\Service\Router $router */
$title = 'Panel administracyjny';
$bodyClass = 'index';
ob_start(); ?>

    <div class="admin-grid">
    <div class="admin-card">
        <div class="genre-form">
        <form onsubmit="event.preventDefault(); SendToAdmin();">
            <input type="text" id="accessCode" placeholder="Kod dostępu"/>

            <button type="submit" class="btn-primary">Prześlij</button>
        </form>
    </div>
    </div>
    </div>
<script>
function SendToAdmin(){
    console.log(document.getElementById("accessCode").value)
    if (document.getElementById("accessCode").value==="Admin123!"){
        document.cookie="role=admin; path=/";
        window.location.href = "index.php?action=admin-index";
    }
    else{console.log("Złe hasło");}

}
</script>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
