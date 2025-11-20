<?php $this->layout('layout')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
<?php $this->stop() ?>

<?php $this->start('js') ?>
    <script src="/portalDeEmpleo2/Public/js/grafico.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <main id="grafico">
        <canvas id="graficoEmpresas"></canvas>
    </main>

<?php $this->stop()?>