Array.prototype.slice.call(document.getElementsByClassName('preset1')).forEach(function(el)
{
	new Knob(el, new Ui['P1']());
    el.addEventListener('change', function  () {
		//console.log(el.value)
	})
})