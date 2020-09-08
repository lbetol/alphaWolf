<?php
namespace abox;
require_once("../includes.php");


if (user()){?>

<header id='head' class="ab-fix-header bheader fheader">
	<img src="img/logo3clara.png" class="h3q abs " style="top:12.5%; left:4vw">
	<div class="hbar tct">
		<div>
			<div class="spd fs"></div>
			<div class="spd link fn fb ab-tooltip" 
                 onclick="ab_apply(function(){
                    <?php
                     if(user()=='aboxaboxaboxaboxaboxaboxaboxabox')
                    {
                    ?>
                            ab_load('/administrative/choice.php')

                    <?php
                    }else {
                    ?>
                            ab_advise('Usuário sem permissão');
                    ab
                    <?php
                    }
                    ?>
                 })"
                 data-content="Painel de controle de usuários,<br>membros e equipes"><icon>&#xe037;</icon>CONTROLE</div>
			<div class="spd link fn fb ab-tooltip" 
                 onclick="ab_load('/projects/hub.php')"
                 data-content="Painel de controle de projetos"><icon>&#xe0fd;</icon>PROJETOS</div>
		</div>

        <icon class="abs cur spd ab-tooltip fn fb"
            style="left:89vw"
            data-content="Manual do sistema"
            onclick="ab_load('manual.php')">&#x74;
        </icon>

		<div class="abs cur spd link ab-tooltip ab-ask fn fb"
            style="left:94vw"
            data-content="Você está prestes a sair do sistema, deseja mesmo sair?"
            data-callback="ab_logoff()">SAIR</div>
	</div>
		<script>
            ab_tooltips();
            ab_dropdowns();
            ab_load("welcome.php");
        </script>
    </header>
<?php
}else {?>
	<div class="ttlecolor fntcolor wfull hfull">  
    <div class="abs zero bar ttlecolor fntcolor">

        <div class="xbar tct"><img class="cur ab-w40% ab-h40%" onclick="ab_login()"  src="img/lobo_clara.svg"></div>
        <button type="submit" class="bwhite fn hpd" onclick="ab_login()" value="Realizar Login">Realizar Login</button>
        
        <script>
            //ab_login();
            setTimeout(ab_reorder,200,"logn");
        </script>
    </div>
</div>

<?php
}
?>



