<?php
require('config.php');
$user = $_COOKIE['user'];
$query = mysqli_query($mysql_link, "SELECT * FROM users WHERE token = '$user'");
$user_logged = mysqli_fetch_assoc($query);

if ($user_logged == NULL){
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/login.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<!--begin::Head-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Главная - NAEBANK</title>
    <link rel="icon" type="image/png" sizes="354x352" href="assets/img/logo_alpha.png">
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./assets_new/css">
    <link href="./assets_new/fullcalendar.bundle.css" rel="stylesheet" type="text/css">
    <link href="./assets_new/plugins.bundle.css" rel="stylesheet" type="text/css">
    <link href="./assets_new/prismjs.bundle.css" rel="stylesheet" type="text/css">
    <link href="./assets_new/style.bundle.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <style type="text/css">
.apexcharts-canvas {
  position: relative;
  user-select: none;
  /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
}


/* scrollbar is not visible by default for legend, hence forcing the visibility */
.apexcharts-canvas ::-webkit-scrollbar {
  -webkit-appearance: none;
  width: 6px;
}

.apexcharts-canvas ::-webkit-scrollbar-thumb {
  border-radius: 4px;
  background-color: rgba(0, 0, 0, .5);
  box-shadow: 0 0 1px rgba(255, 255, 255, .5);
  -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
}


.apexcharts-inner {
  position: relative;
}

.apexcharts-text tspan {
  font-family: inherit;
}

.legend-mouseover-inactive {
  transition: 0.15s ease all;
  opacity: 0.20;
}

.apexcharts-series-collapsed {
  opacity: 0;
}

.apexcharts-tooltip {
  border-radius: 5px;
  box-shadow: 2px 2px 6px -4px #999;
  cursor: default;
  font-size: 14px;
  left: 62px;
  opacity: 0;
  pointer-events: none;
  position: absolute;
  top: 20px;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  white-space: nowrap;
  z-index: 12;
  transition: 0.15s ease all;
}

.apexcharts-tooltip.apexcharts-active {
  opacity: 1;
  transition: 0.15s ease all;
}

.apexcharts-tooltip.apexcharts-theme-light {
  border: 1px solid #e3e3e3;
  background: rgba(255, 255, 255, 0.96);
}

.apexcharts-tooltip.apexcharts-theme-dark {
  color: #fff;
  background: rgba(30, 30, 30, 0.8);
}

.apexcharts-tooltip * {
  font-family: inherit;
}


.apexcharts-tooltip-title {
  padding: 6px;
  font-size: 15px;
  margin-bottom: 4px;
}

.apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
  background: #ECEFF1;
  border-bottom: 1px solid #ddd;
}

.apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
  background: rgba(0, 0, 0, 0.7);
  border-bottom: 1px solid #333;
}

.apexcharts-tooltip-text-value,
.apexcharts-tooltip-text-z-value {
  display: inline-block;
  font-weight: 600;
  margin-left: 5px;
}

.apexcharts-tooltip-text-z-label:empty,
.apexcharts-tooltip-text-z-value:empty {
  display: none;
}

.apexcharts-tooltip-text-value,
.apexcharts-tooltip-text-z-value {
  font-weight: 600;
}

.apexcharts-tooltip-marker {
  width: 12px;
  height: 12px;
  position: relative;
  top: 0px;
  margin-right: 10px;
  border-radius: 50%;
}

.apexcharts-tooltip-series-group {
  padding: 0 10px;
  display: none;
  text-align: left;
  justify-content: left;
  align-items: center;
}

.apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
  opacity: 1;
}

.apexcharts-tooltip-series-group.apexcharts-active,
.apexcharts-tooltip-series-group:last-child {
  padding-bottom: 4px;
}

.apexcharts-tooltip-series-group-hidden {
  opacity: 0;
  height: 0;
  line-height: 0;
  padding: 0 !important;
}

.apexcharts-tooltip-y-group {
  padding: 6px 0 5px;
}

.apexcharts-tooltip-candlestick {
  padding: 4px 8px;
}

.apexcharts-tooltip-candlestick>div {
  margin: 4px 0;
}

.apexcharts-tooltip-candlestick span.value {
  font-weight: bold;
}

.apexcharts-tooltip-rangebar {
  padding: 5px 8px;
}

.apexcharts-tooltip-rangebar .category {
  font-weight: 600;
  color: #777;
}

.apexcharts-tooltip-rangebar .series-name {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

.apexcharts-xaxistooltip {
  opacity: 0;
  padding: 9px 10px;
  pointer-events: none;
  color: #373d3f;
  font-size: 13px;
  text-align: center;
  border-radius: 2px;
  position: absolute;
  z-index: 10;
  background: #ECEFF1;
  border: 1px solid #90A4AE;
  transition: 0.15s ease all;
}

.apexcharts-xaxistooltip.apexcharts-theme-dark {
  background: rgba(0, 0, 0, 0.7);
  border: 1px solid rgba(0, 0, 0, 0.5);
  color: #fff;
}

.apexcharts-xaxistooltip:after,
.apexcharts-xaxistooltip:before {
  left: 50%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}

.apexcharts-xaxistooltip:after {
  border-color: rgba(236, 239, 241, 0);
  border-width: 6px;
  margin-left: -6px;
}

.apexcharts-xaxistooltip:before {
  border-color: rgba(144, 164, 174, 0);
  border-width: 7px;
  margin-left: -7px;
}

.apexcharts-xaxistooltip-bottom:after,
.apexcharts-xaxistooltip-bottom:before {
  bottom: 100%;
}

.apexcharts-xaxistooltip-top:after,
.apexcharts-xaxistooltip-top:before {
  top: 100%;
}

.apexcharts-xaxistooltip-bottom:after {
  border-bottom-color: #ECEFF1;
}

.apexcharts-xaxistooltip-bottom:before {
  border-bottom-color: #90A4AE;
}

.apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {
  border-bottom-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
  border-bottom-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-xaxistooltip-top:after {
  border-top-color: #ECEFF1
}

.apexcharts-xaxistooltip-top:before {
  border-top-color: #90A4AE;
}

.apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {
  border-top-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
  border-top-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-xaxistooltip.apexcharts-active {
  opacity: 1;
  transition: 0.15s ease all;
}

.apexcharts-yaxistooltip {
  opacity: 0;
  padding: 4px 10px;
  pointer-events: none;
  color: #373d3f;
  font-size: 13px;
  text-align: center;
  border-radius: 2px;
  position: absolute;
  z-index: 10;
  background: #ECEFF1;
  border: 1px solid #90A4AE;
}

.apexcharts-yaxistooltip.apexcharts-theme-dark {
  background: rgba(0, 0, 0, 0.7);
  border: 1px solid rgba(0, 0, 0, 0.5);
  color: #fff;
}

.apexcharts-yaxistooltip:after,
.apexcharts-yaxistooltip:before {
  top: 50%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}

.apexcharts-yaxistooltip:after {
  border-color: rgba(236, 239, 241, 0);
  border-width: 6px;
  margin-top: -6px;
}

.apexcharts-yaxistooltip:before {
  border-color: rgba(144, 164, 174, 0);
  border-width: 7px;
  margin-top: -7px;
}

.apexcharts-yaxistooltip-left:after,
.apexcharts-yaxistooltip-left:before {
  left: 100%;
}

.apexcharts-yaxistooltip-right:after,
.apexcharts-yaxistooltip-right:before {
  right: 100%;
}

.apexcharts-yaxistooltip-left:after {
  border-left-color: #ECEFF1;
}

.apexcharts-yaxistooltip-left:before {
  border-left-color: #90A4AE;
}

.apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {
  border-left-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
  border-left-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-yaxistooltip-right:after {
  border-right-color: #ECEFF1;
}

.apexcharts-yaxistooltip-right:before {
  border-right-color: #90A4AE;
}

.apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {
  border-right-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
  border-right-color: rgba(0, 0, 0, 0.5);
}

.apexcharts-yaxistooltip.apexcharts-active {
  opacity: 1;
}

.apexcharts-yaxistooltip-hidden {
  display: none;
}

.apexcharts-xcrosshairs,
.apexcharts-ycrosshairs {
  pointer-events: none;
  opacity: 0;
  transition: 0.15s ease all;
}

.apexcharts-xcrosshairs.apexcharts-active,
.apexcharts-ycrosshairs.apexcharts-active {
  opacity: 1;
  transition: 0.15s ease all;
}

.apexcharts-ycrosshairs-hidden {
  opacity: 0;
}

.apexcharts-selection-rect {
  cursor: move;
}

.svg_select_boundingRect, .svg_select_points_rot {
  pointer-events: none;
  opacity: 0;
  visibility: hidden;
}
.apexcharts-selection-rect + g .svg_select_boundingRect,
.apexcharts-selection-rect + g .svg_select_points_rot {
  opacity: 0;
  visibility: hidden;
}

.apexcharts-selection-rect + g .svg_select_points_l,
.apexcharts-selection-rect + g .svg_select_points_r {
  cursor: ew-resize;
  opacity: 1;
  visibility: visible;
}

.svg_select_points {
  fill: #efefef;
  stroke: #333;
  rx: 2;
}

.apexcharts-svg.apexcharts-zoomable.hovering-zoom {
  cursor: crosshair
}

.apexcharts-svg.apexcharts-zoomable.hovering-pan {
  cursor: move
}

.apexcharts-zoom-icon,
.apexcharts-zoomin-icon,
.apexcharts-zoomout-icon,
.apexcharts-reset-icon,
.apexcharts-pan-icon,
.apexcharts-selection-icon,
.apexcharts-menu-icon,
.apexcharts-toolbar-custom-icon {
  cursor: pointer;
  width: 20px;
  height: 20px;
  line-height: 24px;
  color: #6E8192;
  text-align: center;
}

.apexcharts-zoom-icon svg,
.apexcharts-zoomin-icon svg,
.apexcharts-zoomout-icon svg,
.apexcharts-reset-icon svg,
.apexcharts-menu-icon svg {
  fill: #6E8192;
}

.apexcharts-selection-icon svg {
  fill: #444;
  transform: scale(0.76)
}

.apexcharts-theme-dark .apexcharts-zoom-icon svg,
.apexcharts-theme-dark .apexcharts-zoomin-icon svg,
.apexcharts-theme-dark .apexcharts-zoomout-icon svg,
.apexcharts-theme-dark .apexcharts-reset-icon svg,
.apexcharts-theme-dark .apexcharts-pan-icon svg,
.apexcharts-theme-dark .apexcharts-selection-icon svg,
.apexcharts-theme-dark .apexcharts-menu-icon svg,
.apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {
  fill: #f3f4f5;
}

.apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,
.apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
.apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {
  fill: #008FFB;
}

.apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
.apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
.apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
.apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,
.apexcharts-theme-light .apexcharts-reset-icon:hover svg,
.apexcharts-theme-light .apexcharts-menu-icon:hover svg {
  fill: #333;
}

.apexcharts-selection-icon,
.apexcharts-menu-icon {
  position: relative;
}

.apexcharts-reset-icon {
  margin-left: 5px;
}

.apexcharts-zoom-icon,
.apexcharts-reset-icon,
.apexcharts-menu-icon {
  transform: scale(0.85);
}

.apexcharts-zoomin-icon,
.apexcharts-zoomout-icon {
  transform: scale(0.7)
}

.apexcharts-zoomout-icon {
  margin-right: 3px;
}

.apexcharts-pan-icon {
  transform: scale(0.62);
  position: relative;
  left: 1px;
  top: 0px;
}

.apexcharts-pan-icon svg {
  fill: #fff;
  stroke: #6E8192;
  stroke-width: 2;
}

.apexcharts-pan-icon.apexcharts-selected svg {
  stroke: #008FFB;
}

.apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
  stroke: #333;
}

.apexcharts-toolbar {
  position: absolute;
  z-index: 11;
  max-width: 176px;
  text-align: right;
  border-radius: 3px;
  padding: 0px 6px 2px 6px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.apexcharts-menu {
  background: #fff;
  position: absolute;
  top: 100%;
  border: 1px solid #ddd;
  border-radius: 3px;
  padding: 3px;
  right: 10px;
  opacity: 0;
  min-width: 110px;
  transition: 0.15s ease all;
  pointer-events: none;
}

.apexcharts-menu.apexcharts-menu-open {
  opacity: 1;
  pointer-events: all;
  transition: 0.15s ease all;
}

.apexcharts-menu-item {
  padding: 6px 7px;
  font-size: 12px;
  cursor: pointer;
}

.apexcharts-theme-light .apexcharts-menu-item:hover {
  background: #eee;
}

.apexcharts-theme-dark .apexcharts-menu {
  background: rgba(0, 0, 0, 0.7);
  color: #fff;
}

@media screen and (min-width: 768px) {
  .apexcharts-canvas:hover .apexcharts-toolbar {
    opacity: 1;
  }
}

.apexcharts-datalabel.apexcharts-element-hidden {
  opacity: 0;
}

.apexcharts-pie-label,
.apexcharts-datalabels,
.apexcharts-datalabel,
.apexcharts-datalabel-label,
.apexcharts-datalabel-value {
  cursor: default;
  pointer-events: none;
}

.apexcharts-pie-label-delay {
  opacity: 0;
  animation-name: opaque;
  animation-duration: 0.3s;
  animation-fill-mode: forwards;
  animation-timing-function: ease;
}

.apexcharts-canvas .apexcharts-element-hidden {
  opacity: 0;
}

.apexcharts-hide .apexcharts-series-points {
  opacity: 0;
}

.apexcharts-gridline,
.apexcharts-annotation-rect,
.apexcharts-tooltip .apexcharts-marker,
.apexcharts-area-series .apexcharts-area,
.apexcharts-line,
.apexcharts-zoom-rect,
.apexcharts-toolbar svg,
.apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
.apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
.apexcharts-radar-series path,
.apexcharts-radar-series polygon {
  pointer-events: none;
}


/* markers */

.apexcharts-marker {
  transition: 0.15s ease all;
}

@keyframes opaque {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}


/* Resize generated styles */

@keyframes resizeanim {
  from {
    opacity: 0;
  }
  to {
    opacity: 0;
  }
}

.resize-triggers {
  animation: 1ms resizeanim;
  visibility: hidden;
  opacity: 0;
}

.resize-triggers,
.resize-triggers>div,
.contract-trigger:before {
  content: " ";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  overflow: hidden;
}

.resize-triggers>div {
  background: #eee;
  overflow: auto;
}

.contract-trigger:before {
  width: 200%;
  height: 200%;
}
</style>
  <script async="" src="./assets_new/modules.59fae23e8e8310b9fca6.js.загрузка" charset="utf-8"></script>
  <style type="text/css">iframe#_hjRemoteVarsFrame {display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;}</style>
  <style></style>
  <style>._3emE9--dark-theme .-S-tR--ff-downloader{background:rgba(30,30,30,.93);border:1px solid rgba(82,82,82,.54);box-shadow:0 4px 7px rgba(30,30,30,.55);color:#fff}._3emE9--dark-theme .-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn{background:#3d4b52}._3emE9--dark-theme .-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn:hover{background:#131415}._3emE9--dark-theme .-S-tR--ff-downloader ._10vpG--footer{background:rgba(30,30,30,.93)}._2mDEx--white-theme .-S-tR--ff-downloader{background:#fff;border:1px solid rgba(82,82,82,.54);box-shadow:0 4px 7px rgba(30,30,30,.55);color:#314c75}._2mDEx--white-theme .-S-tR--ff-downloader ._6_Mtt--header{font-weight:700}._2mDEx--white-theme .-S-tR--ff-downloader ._2dFLA--container ._2bWNS--notice{border:0;color:rgba(0,0,0,.88)}._2mDEx--white-theme .-S-tR--ff-downloader ._10vpG--footer{background:#fff}.-S-tR--ff-downloader{display:block;overflow:hidden;position:fixed;bottom:20px;right:7.1%;width:330px;height:180px;background:rgba(30,30,30,.93);border-radius:2px;color:#fff;z-index:99999999;border:1px solid rgba(82,82,82,.54);box-shadow:0 4px 7px rgba(30,30,30,.55);transition:.5s}.-S-tR--ff-downloader._3M7UQ--minimize{height:62px}.-S-tR--ff-downloader._3M7UQ--minimize .nxuu4--file-info,.-S-tR--ff-downloader._3M7UQ--minimize ._6_Mtt--header{display:none}.-S-tR--ff-downloader ._6_Mtt--header{padding:10px;font-size:17px;font-family:sans-serif}.-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn{float:right;background:#f1ecec;height:20px;width:20px;text-align:center;padding:2px;margin-top:-10px;cursor:pointer}.-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn:hover{background:#e2dede}.-S-tR--ff-downloader ._13XQ2--error{color:red;padding:10px;font-size:12px;line-height:19px}.-S-tR--ff-downloader ._2dFLA--container{position:relative;height:100%}.-S-tR--ff-downloader ._2dFLA--container .nxuu4--file-info{padding:6px 15px 0;font-family:sans-serif}.-S-tR--ff-downloader ._2dFLA--container .nxuu4--file-info div{margin-bottom:5px;width:100%;overflow:hidden}.-S-tR--ff-downloader ._2dFLA--container ._2bWNS--notice{margin-top:21px;font-size:11px}.-S-tR--ff-downloader ._10vpG--footer{width:100%;bottom:0;position:absolute;font-weight:700}.-S-tR--ff-downloader ._10vpG--footer ._2V73d--loader{animation:n0BD1--rotation 3.5s linear forwards;position:absolute;top:-120px;left:calc(50% - 35px);border-radius:50%;border:5px solid #fff;border-top-color:#a29bfe;height:70px;width:70px;display:flex;justify-content:center;align-items:center}.-S-tR--ff-downloader ._10vpG--footer ._24wjw--loading-bar{width:100%;height:18px;background:#dfe6e9;border-radius:5px}.-S-tR--ff-downloader ._10vpG--footer ._24wjw--loading-bar ._1FVu9--progress-bar{height:100%;background:#8bc34a;border-radius:5px}.-S-tR--ff-downloader ._10vpG--footer ._2KztS--status{margin-top:10px}.-S-tR--ff-downloader ._10vpG--footer ._2KztS--status ._1XilH--state{float:left;font-size:.9em;letter-spacing:1pt;text-transform:uppercase;width:100px;height:20px;position:relative}.-S-tR--ff-downloader ._10vpG--footer ._2KztS--status ._1jiaj--percentage{float:right}</style><style></style><script type="text/javascript" charset="UTF-8" src="./assets_new/common.js.загрузка"></script><script type="text/javascript" charset="UTF-8" src="./assets_new/util.js.загрузка"></script></head>
  <!--end::Head-->
  <!--begin::Body-->
  <body id="kt_body" class="page-loading-enabled header-fixed header-mobile-fixed sidebar-enabled">
    <!--begin::Page loader-->
    <div class="page-loader page-loader-base">
      <div class="blockui">
        <span>Please wait...</span>
        <span>
          <div class="spinner spinner-primary"></div>
        </span>
      </div>
    </div>
    <!--end::Page Loader-->
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
      <!--begin::Logo-->
      <a href="https://preview.keenthemes.com/metronic/demo10/index.php">
        <img alt="Logo" src="./assets_new/logo-letter-1.png" class="logo-default max-h-30px">
      </a>
      <!--end::Logo-->
      <!--begin::Toolbar-->
      <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left rounded-0" id="kt_header_mobile_toggle">
          <span></span>
        </button>
        <button class="btn btn-hover-icon-primary p-0 ml-5" id="kt_sidebar_mobile_toggle">
          <span class="svg-icon svg-icon-xl">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Design/Substract.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"></rect>
                <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero"></path>
                <path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3"></path>
              </g>
            </svg>
            <!--end::Svg Icon-->
          </span>
        </button>
        <button class="btn btn-hover-icon-primary p-0 ml-2" id="kt_aside_mobile_toggle">
          <span class="svg-icon svg-icon-xl">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/User.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
              </g>
            </svg>
            <!--end::Svg Icon-->
          </span>
        </button>
      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
      <!--begin::Page-->
      <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        <div class="aside aside-left d-flex flex-column" id="kt_aside">
          <!--begin::Brand-->
          <div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-9">
            <!--begin::Logo-->
            <div class="btn p-0 symbol symbol-40 symbol-success" href="/metronic/demo10/index.php" id="kt_quick_user_toggle">
              <div class="symbol-label">
                <img alt="Logo" src="./assets_new/007-boy-2.svg" class="h-75 align-self-end">
              </div>
            </div>
            <!--end::Logo-->
          </div>
          <!--end::Brand-->
          <!--begin::Nav Wrapper-->
          <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid pb-10 scroll ps" style="overflow: hidden;">
            <!--begin::Nav-->
            <ul class="nav flex-column">
              <!--begin::Item-->
              <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="" data-original-title="Главная">
                <a href="index.php" class="nav-link btn btn-icon btn-lg btn-borderless">
                  <span class="svg-icon svg-icon-xxl">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </a>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="" data-original-title="История переводов">
                <a href="table.php" class="nav-link btn btn-icon btn-lg btn-borderless active">
                  <span class="svg-icon svg-icon-xxl">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Communication/Group.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </a>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="" data-original-title="Перевод">
                <a href="transfer.html" class="nav-link btn btn-icon btn-lg btn-borderless">
                  <span class="svg-icon svg-icon-xxl">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </a>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="" data-original-title="Счета">
                <a href="accounts.html" class="nav-link btn btn-icon btn-lg btn-borderless">
                  <span class="svg-icon svg-icon-xxl">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/Shield-check.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </a>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="" data-original-title="Пополнить счет">
                <a href="topupaccount.html" class="nav-link btn btn-icon btn-lg btn-borderless">
                  <span class="svg-icon svg-icon-xxl">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Home/Library.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                        <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </a>
              </li>
              <!--end::Item-->
            </ul>
            <!--end::Nav-->
          <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
          <!--end::Nav Wrapper-->
          <!--begin::Footer-->
          <div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-8">
            <!--begin::Notifications-->
            <a class="btn btn-icon btn-lg btn-borderless mb-1 position-relative" id="kt_quick_notifications_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="" data-original-title="Уведомления">
              <span class="svg-icon svg-icon-xxl">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Design/Layers.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
            
            </a>
            <!--end::Notifications-->
            <!--begin::Quick Actions-->
            <a class="btn btn-icon btn-lg btn-borderless mb-1" id="kt_quick_actions_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="" data-original-title="Быстрые действия">
              <span class="svg-icon svg-icon-xxl">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
            </a>
            <!--end::Quick Actions-->
          </div>
          <!--end::Footer-->
        </div>
        <!--end::Aside-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
          <div style="padding-top: 25px;"></div>
          <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
              <!--begin::Container-->
              <div class="container">
                <!--begin::Dashboard-->
                
                <!--begin::Row-->
                <div class="row">
                  
                  <div class="card card-custom" style="margin-left: 20px; margin-right: 20px; width: 100%">
                  <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                      <h3 class="card-label">История</h3>
                    </div>
                    <div class="card-toolbar">
                      <!--begin::Dropdown-->
                      <div class="dropdown dropdown-inline mr-2">
                        <button onclick="window.location.href = '/export?ban=' + Math.random()" type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                          <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24"></rect>
                              <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                              <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                            </g>
                          </svg>
                          <!--end::Svg Icon-->
                        </span>Экспорт</button>
                        
                      </div>
                      <!--end::Dropdown-->
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Услуга</th>
                                        <th>Комментарий&nbsp;</th>
                                        <th>С какого счета</th>
                                        <th>На какой счет</th>
                                        <th>Сумма</th>
                                        <th>Списание (-) Приход (+)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for i in trans %}
                                    <tr>
                                        <td>Перевод</td>
                                        <td>{{ i[5] }}</td>
                                        <td>{{ getSchet(i[1])[2]}} {{getUser(i[2])[1]}} </td>
                                        <td>{{ getSchet(i[3])[2]}} {{i[4]}}             </td>
                                        <td>{{ i[6] }}</td>
                                        <td>{{ i[7] }}</td>
                                        {% if i[7] == "+" or i[4] == user[1] %}
                                            {% if i[3] == -1%}
                                                <td><a class="btn btn-primary btn-success" href="acceptSchet?id={{i[0]}}">Принять</a></td>
                                            {%endif%}
                                        {% else %}
                                            <td></td>
                                        {% endif %}
                                        
                                    </tr>
                                    {% endfor %}
                                </tfoot>
                            </table>
                        </div>
                  </div>
                </div>

                </div>
                <!--end::Row-->
                <!--end::Dashboard-->
              </div>
              <!--end::Container-->
            </div>
            <!--end::Entry-->
          </div>
          <!--end::Content-->
          <!--begin::Footer-->
          <div class="footer py-2 py-lg-0 my-5 d-flex flex-lg-column" id="kt_footer">
            <!--begin::Container-->
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
              <!--begin::Copyright-->
              <div class="text-dark order-2 order-md-1">
                <span class="text-muted font-weight-bold mr-2">2021©</span>
                <a href="https://midgardrp.ru/" target="_blank" class="text-dark-75 text-hover-primary">NAEBANK (Банк сервера MIDGARD - RP)</a>
              </div>
              <!--end::Copyright-->
            </div>
            <!--end::Container-->
          </div>
          <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Aside Secondary-->
        <div class="sidebar sidebar-right d-flex flex-row-auto flex-column" id="kt_sidebar">
          <!--begin::Aside Secondary Content-->
          <div class="sidebar-content flex-column-fluid pb-10 pt-9 px-5 px-lg-10">
            <!--begin::Stats Widget 13-->
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="card card-custom bg-danger bg-hover-state-danger card-shadowless gutter-b">
              <!--begin::Body-->
              <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"></rect>
                      <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                      <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"></path>
                    </g>
                  </svg>
                  <!--end::Svg Icon-->
                </span>
                <div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5">Корзина</div>
                <div class="font-weight-bold text-inverse-danger font-size-sm">Оплатите все ваши покупки</div>
              </div>
              <!--end::Body-->
            </a>
            <!--end::Stats Widget 13-->
            <!--begin::List Widget 1-->
            <button type="button" class="btn btn-primary btn-lg btn-block">В магазин</button>
            <button type="button" class="btn btn-success btn-lg btn-block">NAEBANK Buisness</button>
            <!--end::List Widget 1-->
          </div>
          <!--end::Aside Secondary Content-->
        </div>
        <!--end::Aside Secondary-->
      </div>
      <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::Notifications Panel-->
		<div id="kt_quick_notifications" class="offcanvas offcanvas-left p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5" style="" kt-hidden-height="40">
				<h3 class="font-weight-bold m-0">Уведомления</h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary text-center" id="kt_quick_notifications_close">
					<i class="fa fa-times icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y" style="height: 779px; overflow: hidden;">
				<!--begin::Nav-->
				<div class="navi navi-icon-circle navi-spacer-x-0">
					{% for item in notifications %}
					<!--begin::Item-->
					<div class="navi-link rounded">
						<div class="symbol symbol-50 symbol-circle mr-3">
							<div class="symbol-label">
								<img src="{{item[4]}}" style="width: 20px; height: 20px;">
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold font-size-lg">{{item[2]}}</div>
							<div class="text-muted">{{item[3]}}</div>
						</div>
					</div>
					
					<!--end::Item-->
					{% endfor %}
				
				</div>
				<!--end::Nav-->
			<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 779px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 300px;"></div></div></div>
			<!--end::Content-->
		</div>
		<!-- end::Notifications Panel-->
    <!--begin::Quick Actions Panel-->
    <div id="kt_quick_actions" class="offcanvas offcanvas-left p-10">
      <!--begin::Header-->
      <div class="offcanvas-header d-flex align-items-center justify-content-between pb-10" style="" kt-hidden-height="56">
        <h3 class="font-weight-bold m-0">Quick Actions 
        <small class="text-muted font-size-sm ml-2">finance &amp; reports</small></h3>
        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_actions_close">
          <i class="ki ki-close icon-xs text-muted"></i>
        </a>
      </div>
      <!--end::Header-->
      <!--begin::Content-->
      <div class="offcanvas-content pr-5 mr-n5 scroll ps" style="height: 779px; overflow: hidden;">
        <div class="row gutter-b">
          <!--begin::Item-->
          <div class="col-6">
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
              <span class="svg-icon svg-icon-3x svg-icon-primary m-0">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Shopping/Euro.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M4.3618034,10.2763932 L4.8618034,9.2763932 C4.94649941,9.10700119 5.11963097,9 5.30901699,9 L15.190983,9 C15.4671254,9 15.690983,9.22385763 15.690983,9.5 C15.690983,9.57762255 15.6729105,9.65417908 15.6381966,9.7236068 L15.1381966,10.7236068 C15.0535006,10.8929988 14.880369,11 14.690983,11 L4.80901699,11 C4.53287462,11 4.30901699,10.7761424 4.30901699,10.5 C4.30901699,10.4223775 4.32708954,10.3458209 4.3618034,10.2763932 Z M14.6381966,13.7236068 L14.1381966,14.7236068 C14.0535006,14.8929988 13.880369,15 13.690983,15 L4.80901699,15 C4.53287462,15 4.30901699,14.7761424 4.30901699,14.5 C4.30901699,14.4223775 4.32708954,14.3458209 4.3618034,14.2763932 L4.8618034,13.2763932 C4.94649941,13.1070012 5.11963097,13 5.30901699,13 L14.190983,13 C14.4671254,13 14.690983,13.2238576 14.690983,13.5 C14.690983,13.5776225 14.6729105,13.6541791 14.6381966,13.7236068 Z" fill="#000000" opacity="0.3"></path>
                    <path d="M17.369,7.618 C16.976998,7.08599734 16.4660031,6.69750122 15.836,6.4525 C15.2059968,6.20749878 14.590003,6.085 13.988,6.085 C13.2179962,6.085 12.5180032,6.2249986 11.888,6.505 C11.2579969,6.7850014 10.7155023,7.16999755 10.2605,7.66 C9.80549773,8.15000245 9.45550123,8.72399671 9.2105,9.382 C8.96549878,10.0400033 8.843,10.7539961 8.843,11.524 C8.843,12.3360041 8.96199881,13.0779966 9.2,13.75 C9.43800119,14.4220034 9.7774978,14.9994976 10.2185,15.4825 C10.6595022,15.9655024 11.1879969,16.3399987 11.804,16.606 C12.4200031,16.8720013 13.1129962,17.005 13.883,17.005 C14.681004,17.005 15.3879969,16.8475016 16.004,16.5325 C16.6200031,16.2174984 17.1169981,15.8010026 17.495,15.283 L19.616,16.774 C18.9579967,17.6000041 18.1530048,18.2404977 17.201,18.6955 C16.2489952,19.1505023 15.1360064,19.378 13.862,19.378 C12.6999942,19.378 11.6325049,19.1855019 10.6595,18.8005 C9.68649514,18.4154981 8.8500035,17.8765035 8.15,17.1835 C7.4499965,16.4904965 6.90400196,15.6645048 6.512,14.7055 C6.11999804,13.7464952 5.924,12.6860058 5.924,11.524 C5.924,10.333994 6.13049794,9.25950479 6.5435,8.3005 C6.95650207,7.34149521 7.5234964,6.52600336 8.2445,5.854 C8.96550361,5.18199664 9.8159951,4.66400182 10.796,4.3 C11.7760049,3.93599818 12.8399943,3.754 13.988,3.754 C14.4640024,3.754 14.9609974,3.79949954 15.479,3.8905 C15.9970026,3.98150045 16.4939976,4.12149906 16.97,4.3105 C17.4460024,4.49950095 17.8939979,4.7339986 18.314,5.014 C18.7340021,5.2940014 19.0909985,5.62999804 19.385,6.022 L17.369,7.618 Z" fill="#000000"></path>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="d-block font-weight-bold font-size-h6 mt-2">Accounting</span>
            </a>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="col-6">
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
              <span class="svg-icon svg-icon-3x svg-icon-primary m-0">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Communication/Mail-attachment.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z" fill="#000000" opacity="0.3"></path>
                    <path d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z" fill="#000000"></path>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="d-block font-weight-bold font-size-h6 mt-2">Members</span>
            </a>
          </div>
          <!--end::Item-->
        </div>
        <div class="row gutter-b">
          <!--begin::Item-->
          <div class="col-6">
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
              <span class="svg-icon svg-icon-3x svg-icon-primary m-0">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Shopping/Box2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000"></path>
                    <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3"></path>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="d-block font-weight-bold font-size-h6 mt-2">Projects</span>
            </a>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="col-6">
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
              <span class="svg-icon svg-icon-3x svg-icon-primary m-0">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Communication/Group.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="d-block font-weight-bold font-size-h6 mt-2">Customers</span>
            </a>
          </div>
          <!--end::Item-->
        </div>
        <div class="row gutter-b">
          <!--begin::Item-->
          <div class="col-6">
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
              <span class="svg-icon svg-icon-3x svg-icon-primary m-0">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Shopping/Chart-bar1.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"></rect>
                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"></rect>
                    <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"></path>
                    <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"></rect>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="d-block font-weight-bold font-size-h6 mt-2">Email</span>
            </a>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="col-6">
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
              <span class="svg-icon svg-icon-3x svg-icon-primary m-0">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Design/Color-profile.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                    <circle fill="#000000" cx="12" cy="9" r="5"></circle>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="d-block font-weight-bold font-size-h6 mt-2">Settings</span>
            </a>
          </div>
          <!--end::Item-->
        </div>
        <div class="row">
          <!--begin::Item-->
          <div class="col-6">
            <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
              <span class="svg-icon svg-icon-3x svg-icon-primary m-0">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Shopping/Euro.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M4.3618034,10.2763932 L4.8618034,9.2763932 C4.94649941,9.10700119 5.11963097,9 5.30901699,9 L15.190983,9 C15.4671254,9 15.690983,9.22385763 15.690983,9.5 C15.690983,9.57762255 15.6729105,9.65417908 15.6381966,9.7236068 L15.1381966,10.7236068 C15.0535006,10.8929988 14.880369,11 14.690983,11 L4.80901699,11 C4.53287462,11 4.30901699,10.7761424 4.30901699,10.5 C4.30901699,10.4223775 4.32708954,10.3458209 4.3618034,10.2763932 Z M14.6381966,13.7236068 L14.1381966,14.7236068 C14.0535006,14.8929988 13.880369,15 13.690983,15 L4.80901699,15 C4.53287462,15 4.30901699,14.7761424 4.30901699,14.5 C4.30901699,14.4223775 4.32708954,14.3458209 4.3618034,14.2763932 L4.8618034,13.2763932 C4.94649941,13.1070012 5.11963097,13 5.30901699,13 L14.190983,13 C14.4671254,13 14.690983,13.2238576 14.690983,13.5 C14.690983,13.5776225 14.6729105,13.6541791 14.6381966,13.7236068 Z" fill="#000000" opacity="0.3"></path>
                    <path d="M17.369,7.618 C16.976998,7.08599734 16.4660031,6.69750122 15.836,6.4525 C15.2059968,6.20749878 14.590003,6.085 13.988,6.085 C13.2179962,6.085 12.5180032,6.2249986 11.888,6.505 C11.2579969,6.7850014 10.7155023,7.16999755 10.2605,7.66 C9.80549773,8.15000245 9.45550123,8.72399671 9.2105,9.382 C8.96549878,10.0400033 8.843,10.7539961 8.843,11.524 C8.843,12.3360041 8.96199881,13.0779966 9.2,13.75 C9.43800119,14.4220034 9.7774978,14.9994976 10.2185,15.4825 C10.6595022,15.9655024 11.1879969,16.3399987 11.804,16.606 C12.4200031,16.8720013 13.1129962,17.005 13.883,17.005 C14.681004,17.005 15.3879969,16.8475016 16.004,16.5325 C16.6200031,16.2174984 17.1169981,15.8010026 17.495,15.283 L19.616,16.774 C18.9579967,17.6000041 18.1530048,18.2404977 17.201,18.6955 C16.2489952,19.1505023 15.1360064,19.378 13.862,19.378 C12.6999942,19.378 11.6325049,19.1855019 10.6595,18.8005 C9.68649514,18.4154981 8.8500035,17.8765035 8.15,17.1835 C7.4499965,16.4904965 6.90400196,15.6645048 6.512,14.7055 C6.11999804,13.7464952 5.924,12.6860058 5.924,11.524 C5.924,10.333994 6.13049794,9.25950479 6.5435,8.3005 C6.95650207,7.34149521 7.5234964,6.52600336 8.2445,5.854 C8.96550361,5.18199664 9.8159951,4.66400182 10.796,4.3 C11.7760049,3.93599818 12.8399943,3.754 13.988,3.754 C14.4640024,3.754 14.9609974,3.79949954 15.479,3.8905 C15.9970026,3.98150045 16.4939976,4.12149906 16.97,4.3105 C17.4460024,4.49950095 17.8939979,4.7339986 18.314,5.014 C18.7340021,5.2940014 19.0909985,5.62999804 19.385,6.022 L17.369,7.618 Z" fill="#000000"></path>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="d-block font-weight-bold font-size-h6 mt-2">Orders</span>
            </a>
          </div>
          <!--end::Item-->
        </div>
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
      <!--end::Content-->
    </div>
    <!--end::Quick Actions Panel-->
    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-left p-10">
      <!--begin::Header-->
      <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5" style="" kt-hidden-height="40">
        <h3 class="font-weight-bold m-0">Профиль</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary text-center" id="kt_quick_user_close">
          <i class="fa fa-times icon-xs text-muted"></i>
        </a>
      </div>
      <!--end::Header-->
      <!--begin::Content-->
      <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y" style="height: 795px; overflow: hidden;">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
          <div class="symbol symbol-100 mr-5">
            <div class="symbol-label" style="background-image:url(&#39;/metronic/theme/html/demo10/dist/assets/media/users/300_21.jpg&#39;)"></div>
            <i class="symbol-badge bg-success"></i>
          </div>
          <div class="d-flex flex-column">
            <a class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $user_logged['nickname'] ?></a>
            <div class="navi mt-2">
              <a class="navi-item">
                <span class="navi-link p-0 pb-2">
                  <span class="navi-text text-muted text-hover-primary"><?php echo $user_logged['email'] ?></span>
                </span>
              </a>
              <a href="logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Выйти</a>
            </div>
          </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
          <!--begin::Item-->
          <a href="profile.html" class="navi-item">
            <div class="navi-link">
              <div class="symbol symbol-40 bg-light mr-3">
                <div class="symbol-label">
                  <span class="svg-icon svg-icon-md svg-icon-success">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/Notification2.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"></path>
                        <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"></circle>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </div>
              </div>
              <div class="navi-text">
                <div class="font-weight-bold">Мой профиль</div>
                <div class="text-muted">Настройки учетной записи</div>
              </div>
            </div>
          </a>
          <!--end:Item-->
        </div>
        <!--end::Nav-->
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 795px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 300px;"></div></div></div>
      <!--end::Content-->
    </div>
    <!-- end::User Panel-->
    <!--begin::Quick Panel-->
    <div id="kt_quick_panel" class="offcanvas offcanvas-left pt-5 pb-10">
      <!--begin::Header-->
      <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5" style="" kt-hidden-height="44">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="https://preview.keenthemes.com/metronic/demo10/index.php#kt_quick_panel_logs">Audit Logs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="https://preview.keenthemes.com/metronic/demo10/index.php#kt_quick_panel_notifications">Notifications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="https://preview.keenthemes.com/metronic/demo10/index.php#kt_quick_panel_settings">Settings</a>
          </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
          <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
            <i class="ki ki-close icon-xs text-muted"></i>
          </a>
        </div>
      </div>
      <!--end::Header-->
      <!--begin::Content-->
      <div class="offcanvas-content px-10">
        <div class="tab-content">
          <!--begin::Tabpane-->
          <div class="tab-pane fade show pt-3 pr-5 mr-n5 active scroll ps ps--active-y" id="kt_quick_panel_logs" role="tabpanel" style="height: 791px; overflow: hidden;">
            <!--begin::Section-->
            <div class="mb-15">
              <h5 class="font-weight-bold mb-5">System Messages</h5>
              <!--begin: Item-->
              <div class="d-flex align-items-center flex-wrap mb-5">
                <div class="symbol symbol-50 symbol-light mr-5">
                  <span class="symbol-label">
                    <img src="./assets_new/006-plurk.svg" class="h-50 align-self-center" alt="">
                  </span>
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Top Authors</a>
                  <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                </div>
                <span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50">+82$</span>
              </div>
              <!--end: Item-->
              <!--begin: Item-->
              <div class="d-flex align-items-center flex-wrap mb-5">
                <div class="symbol symbol-50 symbol-light mr-5">
                  <span class="symbol-label">
                    <img src="./assets_new/015-telegram.svg" class="h-50 align-self-center" alt="">
                  </span>
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Popular Authors</a>
                  <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                </div>
                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+280$</span>
              </div>
              <!--end: Item-->
              <!--begin: Item-->
              <div class="d-flex align-items-center flex-wrap mb-5">
                <div class="symbol symbol-50 symbol-light mr-5">
                  <span class="symbol-label">
                    <img src="./assets_new/003-puzzle.svg" class="h-50 align-self-center" alt="">
                  </span>
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">New Users</a>
                  <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                </div>
                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+4500$</span>
              </div>
              <!--end: Item-->
              <!--begin: Item-->
              <div class="d-flex align-items-center flex-wrap mb-5">
                <div class="symbol symbol-50 symbol-light mr-5">
                  <span class="symbol-label">
                    <img src="./assets_new/005-bebo.svg" class="h-50 align-self-center" alt="">
                  </span>
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Active Customers</a>
                  <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                </div>
                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+4500$</span>
              </div>
              <!--end: Item-->
              <!--begin: Item-->
              <div class="d-flex align-items-center flex-wrap">
                <div class="symbol symbol-50 symbol-light mr-5">
                  <span class="symbol-label">
                    <img src="./assets_new/014-kickstarter.svg" class="h-50 align-self-center" alt="">
                  </span>
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Bestseller Theme</a>
                  <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                </div>
                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+4500$</span>
              </div>
              <!--end: Item-->
            </div>
            <!--end::Section-->
            <!--begin::Section-->
            <div class="mb-5">
              <h5 class="font-weight-bold mb-5">Notifications</h5>
              <!--begin: Item-->
              <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-5">
                <span class="svg-icon svg-icon-warning mr-5">
                  <span class="svg-icon svg-icon-lg">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Home/Library.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                        <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Another purpose persuade</a>
                  <span class="text-muted font-size-sm">Due in 2 Days</span>
                </div>
                <span class="font-weight-bolder text-warning py-1 font-size-lg">+28%</span>
              </div>
              <!--end: Item-->
              <!--begin: Item-->
              <div class="d-flex align-items-center bg-light-success rounded p-5 mb-5">
                <span class="svg-icon svg-icon-success mr-5">
                  <span class="svg-icon svg-icon-lg">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Communication/Write.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Would be to people</a>
                  <span class="text-muted font-size-sm">Due in 2 Days</span>
                </div>
                <span class="font-weight-bolder text-success py-1 font-size-lg">+50%</span>
              </div>
              <!--end: Item-->
              <!--begin: Item-->
              <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-5">
                <span class="svg-icon svg-icon-danger mr-5">
                  <span class="svg-icon svg-icon-lg">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                        <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">Purpose would be to persuade</a>
                  <span class="text-muted font-size-sm">Due in 2 Days</span>
                </div>
                <span class="font-weight-bolder text-danger py-1 font-size-lg">-27%</span>
              </div>
              <!--end: Item-->
              <!--begin: Item-->
              <div class="d-flex align-items-center bg-light-info rounded p-5">
                <span class="svg-icon svg-icon-info mr-5">
                  <span class="svg-icon svg-icon-lg">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/Attachment2.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z" fill="#000000" opacity="0.3" transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)"></path>
                        <path d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z" fill="#000000" transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)"></path>
                        <path d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z" fill="#000000" opacity="0.3" transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)"></path>
                        <path d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z" fill="#000000" opacity="0.3" transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">The best product</a>
                  <span class="text-muted font-size-sm">Due in 2 Days</span>
                </div>
                <span class="font-weight-bolder text-info py-1 font-size-lg">+8%</span>
              </div>
              <!--end: Item-->
            </div>
            <!--end::Section-->
          <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 791px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 300px;"></div></div></div>
          <!--end::Tabpane-->
          <!--begin::Tabpane-->
          <div class="tab-pane fade pt-2 pr-5 mr-n5 scroll ps" id="kt_quick_panel_notifications" role="tabpanel" style="height: 791px; overflow: hidden;">
            <!--begin::Nav-->
            <div class="navi navi-icon-circle navi-spacer-x-0">
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-bell text-success icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">5 new user generated report</div>
                    <div class="text-muted">Reports based on sales</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon2-box text-danger icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">2 new items submited</div>
                    <div class="text-muted">by Grog John</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-psd text-primary icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">79 PSD files generated</div>
                    <div class="text-muted">Reports based on sales</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon2-supermarket text-warning icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                    <div class="text-muted">Total 234 items</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                    <div class="text-muted">Fostest is Barry</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-safe-shield-protection text-danger icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">3 Defence alerts</div>
                    <div class="text-muted">40% less alerts thar last week</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-notepad text-primary icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">Avarage 4 blog posts per author</div>
                    <div class="text-muted">Most posted 12 time</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-users-1 text-warning icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">16 authors joined last week</div>
                    <div class="text-muted">9 photodrapehrs, 7 designer</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon2-box text-info icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">2 new items have been submited</div>
                    <div class="text-muted">by Grog John</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon2-download text-success icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">2.8 GB-total downloads size</div>
                    <div class="text-muted">Mostly PSD end AL concepts</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon2-supermarket text-danger icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                    <div class="text-muted">Total 234 items</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-bell text-primary icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">7 new user generated report</div>
                    <div class="text-muted">Reports based on sales</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
              <!--begin::Item-->
              <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-item">
                <div class="navi-link rounded">
                  <div class="symbol symbol-50 mr-3">
                    <div class="symbol-label">
                      <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                    </div>
                  </div>
                  <div class="navi-text">
                    <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                    <div class="text-muted">Fostest is Barry</div>
                  </div>
                </div>
              </a>
              <!--end::Item-->
            </div>
            <!--end::Nav-->
          <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
          <!--end::Tabpane-->
          <!--begin::Tabpane-->
          <div class="tab-pane fade pt-3 pr-5 mr-n5 scroll ps" id="kt_quick_panel_settings" role="tabpanel" style="height: 791px; overflow: hidden;">
            <form class="form">
              <!--begin::Section-->
              <div>
                <h5 class="font-weight-bold mb-3">Customer Care</h5>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Enable Notifications:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-success switch-sm">
                      <label>
                        <input type="checkbox" checked="checked" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Enable Case Tracking:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-success switch-sm">
                      <label>
                        <input type="checkbox" name="quick_panel_notifications_2">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Support Portal:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-success switch-sm">
                      <label>
                        <input type="checkbox" checked="checked" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
              </div>
              <!--end::Section-->
              <div class="separator separator-dashed my-6"></div>
              <!--begin::Section-->
              <div class="pt-2">
                <h5 class="font-weight-bold mb-3">Reports</h5>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Generate Reports:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-sm switch-danger">
                      <label>
                        <input type="checkbox" checked="checked" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Enable Report Export:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-sm switch-danger">
                      <label>
                        <input type="checkbox" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Allow Data Collection:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-sm switch-danger">
                      <label>
                        <input type="checkbox" checked="checked" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
              </div>
              <!--end::Section-->
              <div class="separator separator-dashed my-6"></div>
              <!--begin::Section-->
              <div class="pt-2">
                <h5 class="font-weight-bold mb-3">Memebers</h5>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Enable Member singup:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-sm switch-primary">
                      <label>
                        <input type="checkbox" checked="checked" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-sm switch-primary">
                      <label>
                        <input type="checkbox" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
                <div class="form-group mb-0 row align-items-center">
                  <label class="col-8 col-form-label">Enable Customer Portal:</label>
                  <div class="col-4 d-flex justify-content-end">
                    <span class="switch switch-sm switch-primary">
                      <label>
                        <input type="checkbox" checked="checked" name="select">
                        <span></span>
                      </label>
                    </span>
                  </div>
                </div>
              </div>
              <!--end::Section-->
            </form>
          <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
          <!--end::Tabpane-->
        </div>
      </div>
      <!--end::Content-->
    </div>
    <!--end::Quick Panel-->
    <!--begin::Chat Panel-->
    <div class="modal modal-sticky modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!--begin::Card-->
          <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header align-items-center px-4 py-3">
              <div class="text-left flex-grow-1">
                <!--begin::Dropdown Menu-->
                <div class="dropdown dropdown-inline">
                  <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-lg">
                      <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <polygon points="0 0 24 0 24 24 0 24"></polygon>
                          <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                          <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </button>
                  <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover py-5">
                      <li class="navi-item">
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-drop"></i>
                          </span>
                          <span class="navi-text">New Group</span>
                        </a>
                      </li>
                      <li class="navi-item">
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-list-3"></i>
                          </span>
                          <span class="navi-text">Contacts</span>
                        </a>
                      </li>
                      <li class="navi-item">
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-rocket-1"></i>
                          </span>
                          <span class="navi-text">Groups</span>
                          <span class="navi-link-badge">
                            <span class="label label-light-primary label-inline font-weight-bold">new</span>
                          </span>
                        </a>
                      </li>
                      <li class="navi-item">
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-bell-2"></i>
                          </span>
                          <span class="navi-text">Calls</span>
                        </a>
                      </li>
                      <li class="navi-item">
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-gear"></i>
                          </span>
                          <span class="navi-text">Settings</span>
                        </a>
                      </li>
                      <li class="navi-separator my-3"></li>
                      <li class="navi-item">
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-magnifier-tool"></i>
                          </span>
                          <span class="navi-text">Help</span>
                        </a>
                      </li>
                      <li class="navi-item">
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-bell-2"></i>
                          </span>
                          <span class="navi-text">Privacy</span>
                          <span class="navi-link-badge">
                            <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                          </span>
                        </a>
                      </li>
                    </ul>
                    <!--end::Navigation-->
                  </div>
                </div>
                <!--end::Dropdown Menu-->
              </div>
              <div class="text-center flex-grow-1">
                <div class="text-dark-75 font-weight-bold font-size-h5">Matt Pears</div>
                <div>
                  <span class="label label-dot label-success"></span>
                  <span class="font-weight-bold text-muted font-size-sm">Active</span>
                </div>
              </div>
              <div class="text-right flex-grow-1">
                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-dismiss="modal">
                  <i class="ki ki-close icon-1x"></i>
                </button>
              </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
              <!--begin::Scroll-->
              <div class="scroll scroll-pull ps" data-height="375" data-mobile-height="300" style="height: 375px; overflow: hidden;">
                <!--begin::Messages-->
                <div class="messages">
                  <!--begin::Message In-->
                  <div class="d-flex flex-column mb-5 align-items-start">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-40 mr-3">
                        <img alt="Pic" src="./assets_new/300_12.jpg">
                      </div>
                      <div>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
                        <span class="text-muted font-size-sm">2 Hours</span>
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">How likely are you to recommend our company to your friends and family?</div>
                  </div>
                  <!--end::Message In-->
                  <!--begin::Message Out-->
                  <div class="d-flex flex-column mb-5 align-items-end">
                    <div class="d-flex align-items-center">
                      <div>
                        <span class="text-muted font-size-sm">3 minutes</span>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                      </div>
                      <div class="symbol symbol-circle symbol-40 ml-3">
                        <img alt="Pic" src="./assets_new/300_21.jpg">
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</div>
                  </div>
                  <!--end::Message Out-->
                  <!--begin::Message In-->
                  <div class="d-flex flex-column mb-5 align-items-start">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-40 mr-3">
                        <img alt="Pic" src="./assets_new/300_21.jpg">
                      </div>
                      <div>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
                        <span class="text-muted font-size-sm">40 seconds</span>
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">Ok, Understood!</div>
                  </div>
                  <!--end::Message In-->
                  <!--begin::Message Out-->
                  <div class="d-flex flex-column mb-5 align-items-end">
                    <div class="d-flex align-items-center">
                      <div>
                        <span class="text-muted font-size-sm">Just now</span>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                      </div>
                      <div class="symbol symbol-circle symbol-40 ml-3">
                        <img alt="Pic" src="./assets_new/300_21.jpg">
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">You’ll receive notifications for all issues, pull requests!</div>
                  </div>
                  <!--end::Message Out-->
                  <!--begin::Message In-->
                  <div class="d-flex flex-column mb-5 align-items-start">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-40 mr-3">
                        <img alt="Pic" src="./assets_new/300_12.jpg">
                      </div>
                      <div>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
                        <span class="text-muted font-size-sm">40 seconds</span>
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">You can unwatch this repository immediately by clicking here: 
                    <a href="https://preview.keenthemes.com/metronic/demo10/index.php#">https://github.com</a></div>
                  </div>
                  <!--end::Message In-->
                  <!--begin::Message Out-->
                  <div class="d-flex flex-column mb-5 align-items-end">
                    <div class="d-flex align-items-center">
                      <div>
                        <span class="text-muted font-size-sm">Just now</span>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                      </div>
                      <div class="symbol symbol-circle symbol-40 ml-3">
                        <img alt="Pic" src="./assets_new/300_21.jpg">
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">Discover what students who viewed Learn Figma - UI/UX Design. Essential Training also viewed</div>
                  </div>
                  <!--end::Message Out-->
                  <!--begin::Message In-->
                  <div class="d-flex flex-column mb-5 align-items-start">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-40 mr-3">
                        <img alt="Pic" src="./assets_new/300_12.jpg">
                      </div>
                      <div>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
                        <span class="text-muted font-size-sm">40 seconds</span>
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">Most purchased Business courses during this sale!</div>
                  </div>
                  <!--end::Message In-->
                  <!--begin::Message Out-->
                  <div class="d-flex flex-column mb-5 align-items-end">
                    <div class="d-flex align-items-center">
                      <div>
                        <span class="text-muted font-size-sm">Just now</span>
                        <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
                      </div>
                      <div class="symbol symbol-circle symbol-40 ml-3">
                        <img alt="Pic" src="./assets_new/300_21.jpg">
                      </div>
                    </div>
                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">Company BBQ to celebrate the last quater achievements and goals. Food and drinks provided</div>
                  </div>
                  <!--end::Message Out-->
                </div>
                <!--end::Messages-->
              <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              <!--end::Scroll-->
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer align-items-center">
              <!--begin::Compose-->
              <textarea class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
              <div class="d-flex align-items-center justify-content-between mt-5">
                <div class="mr-3">
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-clean btn-icon btn-md mr-1">
                    <i class="flaticon2-photograph icon-lg"></i>
                  </a>
                  <a href="https://preview.keenthemes.com/metronic/demo10/index.php#" class="btn btn-clean btn-icon btn-md">
                    <i class="flaticon2-photo-camera icon-lg"></i>
                  </a>
                </div>
                <div>
                  <button type="button" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
                </div>
              </div>
              <!--begin::Compose-->
            </div>
            <!--end::Footer-->
          </div>
          <!--end::Card-->
        </div>
      </div>
    </div>
    <!--end::Chat Panel-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
      <span class="svg-icon">
        <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Navigation/Up-2.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <polygon points="0 0 24 0 24 24 0 24"></polygon>
            <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"></rect>
            <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"></path>
          </g>
        </svg>
        <!--end::Svg Icon-->
      </span>
    </div>
    <!--end::Scrolltop-->
    <script>var HOST_URL = "/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#663259", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#F4E1F0", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="./assets_new/plugins.bundle.js.загрузка"></script>
    <script src="./assets_new/prismjs.bundle.js.загрузка"></script>
    <script src="./assets_new/scripts.bundle.js.загрузка"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="./assets_new/fullcalendar.bundle.js.загрузка"></script>
    <script src="./assets_new/js(1)"></script>
    <script src="./assets_new/gmaps.js.загрузка"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="./assets_new/widgets.js.загрузка"></script>
    <!--end::Page Scripts-->
  
  <!--end::Body-->
</html>