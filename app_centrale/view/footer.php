			</section>


		<footer>
			<!--
			<p><i>Ce site est un prototype, toutes les fonctionnalités ne sont pas encore réalisées.</i></p>
			<p><i>(R) page à réaliser</i></p>
			<p><i>(F) page à finaliser</i></p>
			-->
		</footer>

		<script type='text/javascript' src='./js/main.js'></script>
		<?php
			if(isset($data["Search/main"]))
				echo "<script type='text/javascript' src='./js/searchView.js'></script>";
			if(isset($data["Diapo/main"]))
				echo "<script type='text/javascript' src='./js/diapo.js'></script>";
			if(isset($data["Devis/creer"]))
				echo "<script type='text/javascript' src='./js/createDevis.js'></script>";
		?>
	</body>
</html>
