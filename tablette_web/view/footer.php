			</section>


		<footer>
			<!-- footer ici -->
		</footer>

		<script type='text/javascript' src='./js/main.js'></script>
		<?php
			if(isset($data["Search/main"]))
				echo "<script type='text/javascript' src='./js/searchView.js'></script>";
			if(isset($data["Diapo/main"]))
				echo "<script type='text/javascript' src='./js/diapo.js'></script>";
		?>
	</body>
</html>