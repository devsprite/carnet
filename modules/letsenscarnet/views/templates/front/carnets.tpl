{capture name=path}{l s='Mes carnets' mod='letsenscarnet'}{/capture}
{if isset($carnets) && $carnets}
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!-- Flot -->
<script>
    $(document).ready(function () {
        {if $data_poids}var data_poids = {$data_poids}{/if}

        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
            data_poids,
        ], {
            series: {
                lines: {
                    show: false,
                    fill: true
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#fff'
            },
            colors: ["rgba(86, 127, 1, 0.38)",],
            xaxis: {
                tickColor: "rgba(51, 51, 51, 0.06)",
                mode: "time",
                tickSize: [1, "day"],
                //tickLength: 10,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
            },
            yaxis: {
                ticks: 8,
                tickColor: "rgba(51, 51, 51, 0.06)",
            },
            tooltip: false
        });

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }
    });
</script>
<!-- /Flot -->



<h1 class="page-heading bottom-indent">
    {l s='Vos carnets' mod='letsenscarnet'}
</h1>

<div id="carnets" class="row">
    {foreach from=$carnets item=carnet}
    <div class="col-xs-6 col-md-4">
        <a href="{$link->getModuleLink('letsenscarnet', 'carnet')}?id_carnet={$carnet.id_carnet}">
            <div class="box">
                <p class="">Carnet rempli le {$carnet.date_add|date_format:"%x"}</p>
                <p class="">Poids : {$carnet.poids} kg</p>
                <p class="">{if $carnet.taille != 0}Taille : {$carnet.taille} cm{/if}&nbsp;</p>
                <p class="">{if $carnet.hanches != 0}Hanches : {$carnet.hanches} cm{/if}&nbsp;</p>
                <p class="">{if $carnet.cuisse != 0}Cuisse : {$carnet.cuisse} cm{/if}&nbsp;</p>
            </div>
        </a>
    </div>
    {/foreach}
</div>

{else}
<p>Vous n'avez pas encore de carnet de suivi.</p>
{/if}