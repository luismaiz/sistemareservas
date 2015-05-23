<?php require('Cabecera.php'); 
function nombremes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return $nombre;
} 
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Informes</a>
        </li>
    </ul>
</div>
<div class=" row">
<div class="box col-md-12">
                        <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-edit"></i> Informes</h2>
                        
                        </div>
                        <div class="box-content">
                            <div class="row">
                        <div class="form-group">
<!--                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/sample1.php' target='_blank'>Listado salas <a></li>
                                </ul>-->
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/diarios.php' target='_blank'>Abonos diarios por mes<a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/reservas.php' target='_blank'>Solicitudes clases por mes<a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/mensuales.php' target='_blank'>Abonos mensuales por mes<a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/diariossemana.php' target='_blank'>Abonos diarios semana actual <a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/reservassemana.php' target='_blank'>Solicitudes clases semana actual <a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/mensualessemana.php' target='_blank'>Abonos mensuales semana actual <a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/diariosmes.php' target='_blank'>Abonos diarios <?php $mes=nombremes(date('n')); echo $mes; ?><a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/reservasmes.php' target='_blank'>Solicitudes clases <?php $mes=nombremes(date('n')); echo $mes; ?><a></li>
                                </ul>
                                <ul>
                                    <li><a href='../AplicacionInformes/phpjasperxml_0.9d/mensualesmes.php' target='_blank'>Abonos mensuales <?php $mes=nombremes(date('n')); echo $mes; ?><a></li>
                                </ul>            
                            </div>

                        </div>
                        </div>
                        </div>

    </div>
</div>

<?php require('Pie.php'); ?>
