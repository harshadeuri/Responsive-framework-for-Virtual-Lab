<!DOCTYPE html>
<html>
<head>
	<title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--CSS, Bootstrap, Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/customize-presets.css">
  <link rel="stylesheet" href="css/p1.css">
<!--	<link rel="stylesheet" type="text/css" href="css/index.css">-->
  <link rel="stylesheet" type="text/css" href="css/samp.css">

<!-- JS Files -->
  <script type="text/javascript" src="js/ui.js"></script>
  <script type="text/javascript" src="js/knob.js"></script>
  <script type="text/javascript" src="js/p1.js"></script>
  <script type="text/javascript" src="js/ui.el.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>

<!-- Computing value for the choices-->
<script>
$(document).ready(function(){
  $("#frm_simulate").submit(function(e){
  e.preventDefault();
  $("#imageContainer").empty();
  $("#imageContainer").append('<img src="media/ajax-loader.gif" id="loader" style="position:relative;top:31rem;right:1.25rem;width:3rem; height:3rem; "/>');
  var signal_type = $("#Signal_select").val();
  var amp = $("#Amplitude").val();
  var freq = $("#Frequency").val();
  var ph = $("#Phase").val();
  $.ajaxSetup({cache:false});
  $.post("process.php",{type:signal_type,amplitude:amp,frequency:freq,phase:ph},function(ret){
    if(ret=="nocode"){
      $("#imageContainer").html('<p class="instContainer error">Please enter some code.</p>');
    }
    else if(ret=="filenotcreated"){
      $("#imageContainer").html('<p class="instContainer error">Cannot complete the request due to some error.</p>');
    }
    else
      $("#imageContainer").html('<img src="' + ret + '" width="355" height="253" id="plotimage"/>');
  });

});
});
</script>
</head>

<body>
  <!-- Header -->
  <div class="header">
        <h1 class="logo">Demo of Simple Signals </h1>
  </div>


  <div class="container">
    <!-- Form -->
    <form id="frm_simulate" class="form-horizontal">
    <fieldset>
    <div class="row" style="width:20%;">
      <div class="form-group">
      <label class="col-25 control-label" for="Signal_select" id="sig_sel">Select Signal</label>

      <!-- Signal Selector-->
      <div id="div_signal">
        <div class="col-25">
        <select id="Signal_select" name="Signal_select" class="form-control">
        <option value="1">Sine</option>
        <option value="2">Cosine</option>
        <option value="3">Square</option>
        <option value="4">Sawtooth</option>
        </select>
        </div>
      </div>
      </div>
   </div>


  <!-- Amplitude Knob -->
  <div class="knobs">
<div id="div_voltageknob" >
    <input class="preset1" id="Amplitude" type="range" min="0" max="10" value="0" step="1" data-width="80" data-height="80" data-angleOffset="180" data-angleRange="280">
    <label for="knob_voltage"><center><font size="1"><strong></strong></font></center></label>
    <text style="font-weight: bold;font-size: 15px">Amplitude</text>
  </div>

  <!-- Frequency Knob -->
    <div id="div_voltageknob" >
        <input class="preset1" id="Frequency" type="range" min="0" max="5" value="0" step="1" data-width="80" data-height="80" data-angleOffset="180" data-angleRange="280">
        <label for="knob_voltage"><center><font size="1"><strong></strong></font></center></label>
        <text style="font-weight: bold; font-size: 15px;">Frequency</text>
    </div>

  <!-- Phase Knob -->
    <div id="div_voltageknob" >
        <input class="preset1" id="Phase" type="range" min="0" max="5" value="0" step="1" data-width="80" data-height="80" data-angleOffset="180" data-angleRange="280">
        <label for="knob_voltage"><center><font size="1"><strong></strong></font></center></label>
        <text style="font-weight: bold;font-size: 15px">Phase</text>
    </div>

    <div id="div_submit">  
    <button id="Submit" name="Submit" class="btn btn-primary">Submit</button>
    </div>
    </div>

  </fieldset>
  </form>
  <!-- End of form -->

  <!-- Output -->
<div>
  <img src="images/graph_area.png">
  <div id="imageContainer" class="img-box"></div>
</div>
 
  


</div>


<script src="js/myknobs.js"></script>
<svg>
    <filter id="dropshadow" height="150%" width="150%">
        <feGaussianBlur in="SourceAlpha" stdDeviation="2"/>
        <feOffset dx="0" dy="3" result="offsetblur"/>
        <feMerge>
            <feMergeNode/>
            <feMergeNode in="SourceGraphic"/>
        </feMerge>
    </filter>
    <filter id='inner-shadow'>

        <!-- Shadow Offset -->
        <feOffset
                dx='0'
                dy='5'
                />

        <!-- Shadow Blur -->
        <feGaussianBlur
                stdDeviation='5'
                result='offset-blur'
                />

        <!-- Invert the drop shadow
             to create an inner shadow -->
        <feComposite
                operator='out'
                in='SourceGraphic'
                in2='offset-blur'
                result='inverse'
                />

        <!-- Color & Opacity -->
        <feFlood
                flood-color='black'
                flood-opacity='0.75'
                result='color'
                />

        <!-- Clip color inside shadow -->
        <feComposite
                operator='in'
                in='color'
                in2='inverse'
                result='shadow'
                />

        <!-- Put shadow over original object -->
        <feComposite
                operator='over'
                in='shadow'
                in2='SourceGraphic'
                />
    </filter>
</svg>
</body>
</html>