<?php
/**
 * Contact page
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";

?>

<div class="container-fluid">
    <div class="row center-xs">
        <div class="col-xs-12 col-md-8">
            <h2>Service at it's best</h2>
            <p>
                Here at Multiversum it's our priority to satisfy the customer and to deliver the best of VR.

            </p>
        </div>
    </div>

    <div class="row" style="margin-top: 100px;">
        <div class="col-xs-12 col-md-7 col-md-offset-1">
            <h2>Contact information</h2>
            <ul>
                <li><a><i class="fas fa-location-arrow"></i> 1861 jan pieterszoon coenstraat, Maasdriel, Zeeland </a></li>
                <li><a><i class="fas fa-envelope"></i> jackjones@multiversum.com</a></li>
            </ul>
        </div>

        <div class="col-xs-12 col-md-3">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="100%" height="500" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=jan%pieterszoon%coenstraat%&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 100%;
                            width: 100%;
                        }

                        }

                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 100%;
                            width: 100%;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require "./footer.php"; ?>
