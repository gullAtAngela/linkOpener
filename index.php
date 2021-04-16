<?php
$pageTitle = "Artikelnummern öffnen im Shop";
include_once '../_template/head.php';
?>
<body>
<div class="container">
	<?php include_once '../_template/header.php'; ?>
	<div class="row">
		<div class="col-sm-12 col-md-8">
			<h1><?= $pageTitle ?></h1>
			<h4>Beschreibung:</h4>
			<p>Im folgenden Textfeld können pro Zeile Artikelnummern reinkopiert werden, die dann automatisiert in einem neuen Tab geöffnet werden. Dabei ist es egal ob es eine 5-stellige oder gar 7-stellige Artikelnummer aus dem Angela Bruderer Shop ist. Es ist sogar möglich unterschiedliche Suchbegriffe einzutippen.<br>
			<strong>Wichtig:</strong> Ein Artikel oder Suchbegriff pro Zeile.</p>
		</div>
		<div class="col-sm-12 mb-3">
			<form action="index.php" method="post">
				<div class="row mb-3">
					<div class="col-sm-12">
						<textarea class="form-control" name="artikelnummern" id="artikelnummern" rows="10"><?php echo $_POST['artikelnummern'] ?? ""; ?></textarea>
					</div>
				</div>
				<div class="row justify-content-end">
					<div class="col-sm-2">
						<input class="form-control btn btn-primary" type="submit" name="Öffnen" value="Artikel öffnen">
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php 
	if (isset($_POST['artikelnummern'])) {
		$articles = explode("\n", $_POST['artikelnummern']);
	} ?>
	<div class="row mb-5">
		<div class="col-sm-12">
			<?php if (isset($_POST['artikelnummern'])) {
					if (!empty($articles)) { ?>
						<p>Sollte mal ein Link nicht öffnen, können in der untenstehenden Liste auch alle aufgerufenen Seiten nochmals geöffnet werden.</p>
						<?php
						foreach ($articles as $article) { ?>
							<script>
								window.open('https://www.angela-bruderer.ch/de/catalogsearch/result/?q=<?= trim($article) ?>', '_blank');
							</script>
							<?php 
							linkHandler(trim($article));
						}
					}
				} else { ?>
				<div class="alert alert-warning" role="alert">
					<h5>Keine Übereinstimmungen gefunden.</h5>
					<p>Bitte gib eine Artikelnummer oder einen Suchbegriff ein.</p>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php include '../_template/footer.php'; ?>
<?php
function linkHandler($keyword) {
	if ($keyword != "") {
		if (preg_match('/[0-9]/', $keyword)) {
			echo "Artikel: ";
		} else {
			echo "Suchbegriff: ";
		}
	}

	echo '<a class="links" target="_blank" href="https://www.angela-bruderer.ch/de/catalogsearch/result/?q=' . $keyword . '">' . $keyword . '</a><br>';
} ?>