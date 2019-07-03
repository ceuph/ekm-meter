<?php

/* @var $this yii\web\View */

$this->title = 'CEU HAU DareTo Project';
?>
<div class="site-index">

    <div class="jumbotron">
        <p class="lead">Carbon Footprint for the Month of <?= date('F') ?></p>
        <h1><?= number_format($total * $emissionFactor->value, 2) ?> KgCO<sub>2</sub></h1>

        <p class="lead">TOTAL CARBON FOOTPRINT</p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach ($results as $result) : ?>
                <div class="col-lg-4 text-center jumbotron">
                    <h1><?= number_format($result['sum_diff'] * $emissionFactor->value, 2) ?></h1>
                    <h2><?= strtoupper($result['name']) ?></h2>
                    <p>KgCO<sub>2</sub></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <var>KgCo<sub>2</sub></var> = <var>KWh</var> * <var>t-CO<sub>2</sub>/MWh</var> <sup>[1]</sup>
                </p>
                <p>
                    <var>t-CO<sub>2</sub>/MWh</var> = <?= $emissionFactor->value ?> <sup>[2]</sup>
                </p>
            </div>
            <div class="col-lg-12">
                <p>
                    [1] - <a href="https://www.rappler.com/brandrap/161573-household-carbon-emission-computation">https://www.rappler.com/brandrap/161573-household-carbon-emission-computation</a>
                </p>
                <p>
                    [2] - <a href="https://www.doe.gov.ph/electric-power/2015-2017-national-grid-emission-factor-ngef">https://www.doe.gov.ph/electric-power/2015-2017-national-grid-emission-factor-ngef</a>
                </p>
            </div>
        </div>
    </div>
</div>
