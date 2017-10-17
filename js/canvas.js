// ADDING A CANVAS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$('#shape').change(function () {
  var selectBox = $(this).val();

  $('.clear-appear').fadeOut(300);
  $('.canvas-opt').fadeOut(300);
  $('#hide-on-canvas').slideDown(300);

  if (selectBox == 'canvas') { // IF CANVAS IS SELECTED THEN DO THIS

    $('#hide-on-canvas').slideUp(300);
    $('.canvas-opt').fadeIn(300);
    $('.clear-appear').hide().html('<a id="clear" href="#" class="button">Clear Drawing</a>').fadeIn(
      300);
    $('.canvas-opt').html(
      '<div id="color-wrap" class="large-8 columns"><!-- Colour palettes will appear here --></div><div id="radius" class="large-4 columns"><div class="radControl"><i id="lowerRadius" class="fi-minus"></i></div><span style="margin-left: 10px;">Brush Size</span><span style="padding: 0 10px 0 5px;" id="radVal">15</span><div class="radControl"><i id="addRadius" class="fi-plus"></i></div></div>'
    )

    var makeCanvas = document.createElement('canvas'); // Makes the canvas element
    var wrapper = document.getElementById('obj');

    makeCanvas.id = "cArea"; // Give it an ID
    makeCanvas.className = "myCanvas";
    makeCanvas.width = wrapper.offsetWidth;
    makeCanvas.height = wrapper.offsetHeight;
    makeCanvas.style.cssText = 'background-color: transparent;';

    $(wrapper).html(makeCanvas); // Appends the created canvas into a html wrapper


    // DRAWING ON CANVAS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    var canvas = document.getElementById('cArea');
    var ctx = canvas.getContext('2d');

    var radius = 15; // Width of the drawing brush
    var drag = false; // Used with up / down eventlistener to tell canvas when mouse is down or up

    ctx.lineWidth = radius * 2; // increases the stroke line width to keep a constant flow

    var putPoint = function (e) {
      if (drag) {
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
        ctx.beginPath();
        ctx.arc(e.offsetX, e.offsetY, radius, 0, Math.PI * 2);
        ctx.fill();
        ctx.beginPath();
        ctx.moveTo(e.offsetX, e.offsetY);
      }
    }

    var mouseIsDown = function (e) { // Tells canvas mousedown is true
      drag = true;
      putPoint(e);
    }

    var mouseIsUp = function () { // Tells canvas mousedown is false
      drag = false;
      ctx.beginPath(); // Ends the previous path and begins anew
    }

    canvas.addEventListener('mousedown', mouseIsDown);
    canvas.addEventListener('mouseup', mouseIsUp);
    canvas.addEventListener('mousemove', putPoint);



    // RADIUS CONTROL ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



    var setRadius = function (updateRadius) {
      if (updateRadius < minRad) {
        updateRadius = minRad;
      }
      if (updateRadius > maxRad) {
        updateRadius = maxRad;
      }
      radius = updateRadius;
      ctx.lineWidth = radius * 2;
      radSpan.innerHTML = radius; // Updates the number on screen to show current size
    }

    var minRad = null; // Min Size
    var maxRad = 50; // Max size
    var defaultRad = 15; // Default Size
    var interval = 5; // Interval of how much it'll increase / decrease by
    var radSpan = document.getElementById('radVal');
    var lowerRad = document.getElementById('lowerRadius');
    var addRad = document.getElementById('addRadius');

    lowerRad.addEventListener('click', function () {
      setRadius(radius - interval)
    });
    addRad.addEventListener('click', function () {
      setRadius(radius + interval)
    });


    // COLOUR PALETTE ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    var colors = ['#F2F2F2', '#888888', '#8884ff', '#f4d35e', '#ee964b', '#f15156', '#50ED65'];

    var makeColor = document.createElement('div'); // Makes a div
    makeColor.id = 'colour'; // Gives div an ID of colour
    document.getElementById('color-wrap').appendChild(makeColor); // Appends the div into the color-wrap div

    for (var i = 0; i < colors.length; i++) { // For loop to generate the color palettes into the HTML based on how many colours are present in the array
      var palette = document.createElement('div');
      palette.className = 'palette'; // Gives a class name
      palette.style.backgroundColor = colors[i];
      palette.addEventListener('click', setPalette);
      document.getElementById('colour').appendChild(palette);
    }

    function setColor(color) {
      ctx.fillStyle = color;
      ctx.strokeStyle = color;
      var activated = document.getElementsByClassName('activated')[0]; // indexes it as part of the array
      if (activated) {
        activated.className = 'palette';
      }
    }

    function setPalette(e) {
      var palettes = e.target;

      setColor(palettes.style.backgroundColor);

      palettes.className += ' activated';
    }


    // CLEAR CANVAS AND ANIMATE IN ANOTHER  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    document.getElementById('clear').onclick = function () {

      var makeCanvas = document.createElement('canvas'); // Makes the canvas element
      var wrapper = document.getElementById('cArea');

      ctx.clearRect(0, 0, wrapper.offsetWidth, wrapper.offsetHeight);

    }

  }
});
