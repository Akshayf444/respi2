<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
    exit();
}
require_once("../includes/initialize.php");
require_once './header.php';
$conditions = array('GROUP BY rm.smswayid ORDER BY Practicing_Change DESC LIMIT 1');
$topper = man_power::bmViewStatus($conditions);

?>
<style>
    .gvstyling th
    {
        font-size: 12px;
        padding-left: 10px;
        text-align: left;
    }
    .gvstyling td
    {
        text-align: left;
        font-size: 12px;
        padding-left: 10px;
    }
    .gvstyling tr
    {
        text-align: left;
        padding-left: 10px;
        font-size: 12px;
    }
    .btn
    {
        padding-left:10px;
    }
</style>


<!-- Bootstrap Core CSS -->
<script src="http://instacom.in/Cutisera/js/jquery-1.9.1.min.js"></script>
<link href="http://instacom.in/Cutisera/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="http://instacom.in/Cutisera/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- Timeline CSS -->
<link href="http://instacom.in/Cutisera/dist/css/timeline.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="http://instacom.in/Cutisera/dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Morris Charts CSS -->
<link href="http://instacom.in/Cutisera/bower_components/morrisjs/morris.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="http://instacom.in/Cutisera/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"
      type="text/css">

<!-- it works the same with all jquery version from 1.x to 2.x -->
<script type="text/javascript" src="http://instacom.in/Cutisera/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://instacom.in/Cutisera/js/jssor.js"></script>
<script type="text/javascript" src="http://instacom.in/Cutisera/js/jssor.slider.js"></script>
<script>
    //Reference http://www.jssor.com/development/tip-make-responsive-slider.html

    var _CaptionTransitions = [];
    _CaptionTransitions["CLIP|L"] = {$Duration: 600, $Clip: 1, $Easing: $JssorEasing$.$EaseInOutCubic};
    _CaptionTransitions["RTT|10"] = {$Duration: 600, $Zoom: 11, $Rotate: 1, $Easing: {$Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo}, $Opacity: 2, $Round: {$Rotate: 0.8}};
    _CaptionTransitions["ZMF|10"] = {$Duration: 600, $Zoom: 11, $Easing: {$Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2};
    _CaptionTransitions["FLTTR|R"] = {$Duration: 600, x: -0.2, y: -0.1, $Easing: {$Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave}, $Opacity: 2, $Round: {$Top: 1.3}};
</script> 
<script>
    jQuery(document).ready(function ($) {
        //Reference http://www.jssor.com/development/tip-make-responsive-slider.html

        var _CaptionTransitions = [];
        _CaptionTransitions["CLIP|L"] = {$Duration: 600, $Clip: 1, $Easing: $JssorEasing$.$EaseInOutCubic};
        _CaptionTransitions["RTT|10"] = {$Duration: 600, $Zoom: 11, $Rotate: 1, $Easing: {$Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo}, $Opacity: 2, $Round: {$Rotate: 0.8}};
        _CaptionTransitions["ZMF|10"] = {$Duration: 600, $Zoom: 11, $Easing: {$Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2};
        _CaptionTransitions["FLTTR|R"] = {$Duration: 600, x: -0.2, y: -0.1, $Easing: {$Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave}, $Opacity: 2, $Round: {$Top: 1.3}};

        var options = {
            $AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
            $DragOrientation: 3, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0),

            $CaptionSliderOptions: {//[Optional] Options which specifies how to animate caption
                $Class: $JssorCaptionSlider$, //[Required] Class to create instance to animate caption
                $CaptionTransitions: _CaptionTransitions, //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                $PlayInMode: 1, //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
            }
        };

        var jssor_slider1 = new $JssorSlider$("slider1_container", options);
        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizes
        function ScaleSlider() {

            //reserve blank width for margin+padding: margin+padding-left (10) + margin+padding-right (10)
            var paddingWidth = 20;

            //minimum width should reserve for text
            var minReserveWidth = 150;

            var parentElement = jssor_slider1.$Elmt.parentNode;

            //evaluate parent container width
            var parentWidth = parentElement.clientWidth;

            if (parentWidth) {

                //exclude blank width
                var availableWidth = parentWidth - paddingWidth;

                //calculate slider width as 70% of available width
                var sliderWidth = availableWidth * 0.7;

                //slider width is maximum 600
                sliderWidth = Math.min(sliderWidth, 600);

                //slider width is minimum 200
                sliderWidth = Math.max(sliderWidth, 200);

                //evaluate free width for text, if the width is less than minReserveWidth then fill parent container
                if (availableWidth - sliderWidth < minReserveWidth) {

                    //set slider width to available width
                    sliderWidth = availableWidth;

                    //slider width is minimum 200
                    sliderWidth = Math.max(sliderWidth, 200);
                }

                jssor_slider1.$ScaleWidth(sliderWidth);
            }
            else
                window.setTimeout(ScaleSlider, 30);
        }
        ScaleSlider();

        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        //responsive code end
    });
</script>
<div id="page-wrapper" style="background-image: url('images/screen2.jpg'); margin: 0px 0 0 0px; background-repeat:repeat-y; background-size:100%">

    <div class="row">
        <div class="col-lg-12" style="padding-top:20px">
            <a href="viewStatus.php" class="btn btn-info pull-right" >View</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <br />
    <?php
   // $conditions = array('WHERE rm.SM_EMP_ID = ' . $sm_empid);
    $dashboard = man_power::bmViewStatus();
    if (!empty($dashboard)) {
        $dashboard = array_shift($dashboard);
    }
    ?>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div style="background-color:#f0ad4e;border-radius:4px;border:1px solid transparent">
                <div class="panel-heading">
                    <div class="row">
<!--                        <div class="col-xs-1">
                            <i class="glyphicon glyphicon-education fa-3x" style="color:white"></i>
                        </div>-->
                        <div class="col-xs-12 text-right">
                            <div class="medium">
                                <label  id="lblPoint" style="color:white"><?php echo isset($dashboard->Practicing_Change) ? $dashboard->Practicing_Change : 0; ?>
                                </label>
                            </div>
                            <div><span style="color:white">Drs. Started Practicing Change</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="col-lg-6 col-md-6">
            <div style="background-color:#DE7F5B;border-radius:4px;border:1px solid transparent">
                <div class="panel-heading">
                    <div class="row">
<!--                        <div class="col-xs-1">
                            <i class="glyphicon glyphicon-align-center fa-3x" style="color:white"></i>
                        </div>-->
                        <div class="col-xs-12 text-right">
                            <div class="medium">
                                <label id="lblRx"  style="color:white"><?php echo isset($dashboard->Check_Points) ? $dashboard->Check_Points : 0; ?>
                                </label>
                            </div>
                            <div>
                                <span style="color:white"> Rotahaler Check Points</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row" style="padding-top:20px">
        <div class="col-lg-6 col-md-6">
            <div style="background-color:#36B37F;border-radius:4px;border:1px solid transparent">
                <div class="panel-heading">
                    <div class="row">
<!--                        <div class="col-xs-1">
                            <i class="glyphicon glyphicon-hourglass fa-3x" style="color:white"></i>
                        </div>-->
                        <div class="col-xs-12 text-right">
                            <div class="medium">
                                <label  id="lblpending" style="color:white"><?php echo isset($dashboard->RCP_Drives) ? $dashboard->RCP_Drives : 0; ?>
                                </label>
                            </div>
                            <div><span style="color:white">RCP Drives</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="col-lg-6 col-md-6">
            <div style="background-color:#5BC6DE;border-radius:4px;border:1px solid transparent">
                <div class="panel-heading">
                    <div class="row">
<!--                        <div class="col-xs-1">
                            <i class="glyphicon glyphicon-remove fa-3x" style="color:white"></i>
                        </div>-->
                        <div class="col-xs-12 text-right">
                            <div class="medium">
                                <label id="lblunapprove"  style="color:white"><?php echo isset($dashboard->Rotahaler) ? $dashboard->Rotahaler : 0; ?>
                                </label>
                            </div>
                            <div>
                                <span style="color:white">No. of Rotahaler Changed</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div style="display: block; margin: 10px auto 0 auto; padding: 10px 5px 5px 10px; width: 96%; max-width: 940px; min-width: 240px; font-size: .8em; line-height: 1.5em;">
            <!-- Jssor Slider Begin -->
            <!-- To move inline styles to css file/block, please specify a class name for each element. -->
            <div id="slider1_container" style="position: relative; margin: 0px 5px 5px 0px; float: left; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden;">
                <!-- Slides Container -->
                <div u="slides" style="cursor: move; text-align:center; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px; overflow: hidden;">
                    <div>
                        <img u="image" src="http://instacom.in/respi2/Images/darkback.jpg" />
                        <div id="dv_top"  style="position: absolute; top: 10px;width: 100%; height: 20px; font-size: 25px; font-weight:500; color: #fff; line-height: 30px;"> Most No. Of Doctors Converted </div>
                        <?php
                        if (!empty($topper)) {
                            $topper = array_shift($topper);
                        }
                        ?>
                        <div id="dv_tm1name"  u="caption" t="FLTTR|R" style="position: absolute; left:0px; top: 70px; width: 100%; height: 20px; font-size: 43px; color: #fff; line-height: 40px;"><?php echo isset($topper->BM_Name) ? $topper->BM_Name : 'NA'; ?></div>
                        <br />
                        <div id="dv_tm1Region"  u="caption" t="FLTTR|R" style="position: absolute; left:0px; top: 120px; width: 100%;height: 10px; font-size: 36px; color: #fff; line-height: 40px;"><?php echo isset($topper->Practicing_Change) ? $topper->Practicing_Change : '-'; ?></div>
                        <br />
                        <div id="dv_tm1Rx"  u="caption" t="FLTTR|R" style="position: absolute; left:0px; top: 170px;width: 100%; height: 20px; font-size: 36px;font-weight:600; color:#fff; line-height: 40px;"><?php echo isset($topper->Region) ? $topper->Region : 'NA'; ?></div>
                    </div>
                    <div>
                        <?php $conditions = array('GROUP BY rm.smswayid ORDER BY Check_Points DESC LIMIT 1');
                        $checkPointTopper = man_power::bmViewStatus($conditions);
                        if (!empty($checkPointTopper)) {
                            $checkPointTopper = array_shift($checkPointTopper);
                        }
                        ?>
                        <img u="image" src="http://instacom.in/respi2/Images/darkback.jpg" />
                        <div id="Div1"  style="position: absolute; top: 10px;width: 100%; height: 20px; font-size: 23px; color: #fff; line-height: 30px;">Most No. Of Rotahaler Check Points</div>
                        <div id="dv_tm2name"  u="caption" t="ZMF|10" style="position: absolute;left:0px; top: 70px; width: 100%; height: 40px; font-size: 43px; color: #fff; line-height: 40px;"><?php echo isset($checkPointTopper->BM_Name) ? $checkPointTopper->BM_Name : 'NA'; ?></div>
                        <br />
                        <div id="dv_tm2Region"  u="caption" t="ZMF|10" style="position: absolute; left:0px;top: 120px; width: 100%; height: 40px; font-size: 36px; color: #fff; line-height: 40px;"><?php echo isset($checkPointTopper->Check_Points) ? $checkPointTopper->Check_Points : '-'; ?></div>
                        <br />
                        <div id="dv_tm2Rx"  u="caption" t="ZMF|10" style="position: absolute;left:0px; top: 170px; width: 100%; height: 20px; font-size: 36px;font-weight:600;color:#fff;  line-height: 40px;"><?php echo isset($checkPointTopper->Region) ? $checkPointTopper->Region : 'NA'; ?></div>
                    </div>
                    <div>
                        <?php $conditions = array('GROUP BY rm.smswayid ORDER BY Rotahaler DESC LIMIT 1');
                        $RotahalerTopper = man_power::bmViewStatus($conditions);
                        if (!empty($RotahalerTopper)) {
                            $RotahalerTopper = array_shift($RotahalerTopper);
                        }
                        ?>
                        <img u="image" src="http://instacom.in/respi2/Images/darkback.jpg" />
                        <div id="Div2"  style="position: absolute;  top: 10px;width: 100%; height: 20px; font-size: 23px; color: #fff; line-height: 30px;">Most No. Of Rotahaler Changed</div>
                        <div id="dv_tm3name"  u="caption" t="RTT|10" style="position: absolute;left:0px;  top: 70px; width: 100%; height: 40px; font-size: 43px; color: #fff; line-height: 40px;"><?php echo isset($RotahalerTopper->BM_Name) ? $RotahalerTopper->BM_Name : 'NA'; ?></div>
                        <br />
                        <div id="dv_tm3Region"  u="caption" t="RTT|10" style="position: absolute;left:0px; top: 120px; width: 100%; height: 40px; font-size: 36px; color: #fff; line-height: 40px;"><?php echo isset($RotahalerTopper->Rotahaler) ? $RotahalerTopper->Rotahaler : 'NA'; ?></div>
                        <br />
                        <div id="dv_tm3Rx"  u="caption" t="RTT|10" style="position: absolute;left:0px;top: 170px; width: 100%; height: 20px; font-size: 36px;font-weight:600; color:#fff; line-height: 40px;"><?php echo isset($RotahalerTopper->Region) ? $RotahalerTopper->Region : 'NA'; ?></div>
                    </div>
                </div>
                <a style="display: none" href="http://www.jssor.com">Bootstrap Slider</a>
                <!-- Trigger -->
            </div>

        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>