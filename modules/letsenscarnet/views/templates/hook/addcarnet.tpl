{if !empty($carnets)}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <i class="icon-leaf"></i> {l s='Carnet de suivi' mod='letsenscarnet'}
                </div>
                <div id="" class="well">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Poids</th>
                            <th>Taille</th>
                            <th>Hanches</th>
                            <th>Cuisses</th>
                            <th>Motivation</th>
                            <th>Satisfaction</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach item=carnet from=$carnets}
                            <tr>
                                <td class="pointer" onclick="document.location='index.php?controller=AdminLetsenscarnet&id_carnet={$carnet['id_carnet']|intval}&viewcarnet&token={getAdminToken tab='AdminLetsenscarnet'}'">{$carnet['date_add']|date_format:'%x'}</td>
                                <td class="pointer" onclick="document.location='index.php?controller=AdminLetsenscarnet&id_carnet={$carnet['id_carnet']|intval}&viewcarnet&token={getAdminToken tab='AdminLetsenscarnet'}'">{$carnet['poids']} kg</td>
                                <td class="pointer" onclick="document.location='index.php?controller=AdminLetsenscarnet&id_carnet={$carnet['id_carnet']|intval}&viewcarnet&token={getAdminToken tab='AdminLetsenscarnet'}'">{$carnet['taille']} cm</td>
                                <td class="pointer" onclick="document.location='index.php?controller=AdminLetsenscarnet&id_carnet={$carnet['id_carnet']|intval}&viewcarnet&token={getAdminToken tab='AdminLetsenscarnet'}'">{$carnet['hanches']} cm</td>
                                <td class="pointer" onclick="document.location='index.php?controller=AdminLetsenscarnet&id_carnet={$carnet['id_carnet']|intval}&viewcarnet&token={getAdminToken tab='AdminLetsenscarnet'}'">{$carnet['cuisse']} cm</td>
                                <td class="pointer" onclick="document.location='index.php?controller=AdminLetsenscarnet&id_carnet={$carnet['id_carnet']|intval}&viewcarnet&token={getAdminToken tab='AdminLetsenscarnet'}'">{if $carnet['motivation'] != 0}{$carnet['motivation']}{/if}</td>
                                <td class="pointer" onclick="document.location='index.php?controller=AdminLetsenscarnet&id_carnet={$carnet['id_carnet']|intval}&viewcarnet&token={getAdminToken tab='AdminLetsenscarnet'}'">{if $carnet['programme_satisfaction_resultat'] != 0}{$carnet['programme_satisfaction_resultat']}{/if}</td>
                            </tr>
                        {/foreach}
                        </tbody>

                    </table>


                </div>
            </div>
        </div>
    </div>
{/if}
