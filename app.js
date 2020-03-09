// display 'are you over 18' modal on load
$(window).on('load',function(){
  $('#staticBackdrop').modal('show');
});

// off-canvas menu

$(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready
  console.log("document is ready");
  $('[data-toggle="offcanvas"], #navToggle').on('click', function () {
  $('.offcanvas-collapse').toggleClass('open');
  })
});

$('.spirit').on('click', function(){
  $('.offcanvas-collapse').toggleClass('open');
  $('.content').addClass('hidden');
  $('.form').addClass('hidden');
  $('.searchResult').removeClass('hidden');

  var spiritName = this.innerText;
  console.log(spiritName);

  $.getJSON('https://www.thecocktaildb.com/api/json/v1/1/filter.php?i=' + spiritName, function(data) {
    for(i=0; i<data.drinks.length; i++){

    
    var text = `<div class="row" style="padding-top: 5%;">
                <div class="col-5">
                  <img src="${data.drinks[i].strDrinkThumb}" class="rounded img-thumbnail p-0" style="height: 100px;" alt="...">
                </div>
                <div class="col-7">
                  <p>${data.drinks[i].strDrink}</p>
                  <a class="btn btn-primary btn-sm" href="#" role="button">more</a>
                </div>
                </div>`
                
              $("#searchResult"+i).html(text);
    }
    console.log(data)
});
})

//end of off-canvas menu

//user interaction
$('.navbar-brand').on('click', function(){
  $('.content').removeClass('hidden');
  $('.searchResult').addClass('hidden');
  $('.form').addClass('hidden');

})

$('#createRecipe').on('click', function(){
  $('.offcanvas-collapse').toggleClass('open');
  $('.form').removeClass('hidden');
  $('.content').addClass('hidden');
  $('.searchResult').addClass('hidden');
})

$('.fa-search').on('click', function(){
  $('#searchbar').toggleClass('hidden');
})
//end of user interaction

//form ingredients count
var ingredientsCount = 2;
$('#ingreButton').on('click', function(){
  var html = `<div class="form-row">
                <div class="form-group col-6">
                  <label for="quantity[${ingredientsCount}]">Quantity</label>
                  <input type="number" class="form-control" name="quantity[${ingredientsCount}]" id="quantity">
                </div>
                <div class="form-group col-6">
                  <label for="measurement[${ingredientsCount}]">Measurement</label>
                  <select class="form-control" id="measurement" name="measurement[${ingredientsCount}]">
                    <option>ml</option>
                    <option>dash</option>
                    <option>drop</option>
                    <option>bunch</option>
                  </select>
                </div>
                <div class="form-group col-12">
                  <label for="item[${ingredientsCount}]">Item</label>
                  <input type="text" class="form-control" name="item[${ingredientsCount}]" id="item">
                </div>
              </div>`
  if(ingredientsCount<15) {
    $(".newIngre").append(html);
    ingredientsCount++
  }
  if(ingredientsCount==15) {
    $("#ingreButton").text('Maxium 15 ingredients.');
  }
 

})

//form step count
var stepCount = 3;
$('#stepButton').on('click', function(){
  var html = `<div class="form-group">
                <label for="step1">step ${stepCount}</label>
                <textarea class="form-control" name="step${stepCount}" rows="3"></textarea>
              </div>`
  if(stepCount<6) {
    $(".newStep").append(html);
    stepCount++
  }

  if(stepCount==6) {
    $("#stepButton").text('Maxium 5 steps.');
  }
 

})


//dark theme
!function(){var t,e=document.getElementById("darkSwitch");if(e){t=null!==localStorage.getItem("darkSwitch")&&"dark"===localStorage.getItem("darkSwitch"),(e.checked=t)?document.body.setAttribute("data-theme","dark"):document.body.removeAttribute("data-theme"),e.addEventListener("change",function(t){e.checked?(document.body.setAttribute("data-theme","dark"),localStorage.setItem("darkSwitch","dark")):(document.body.removeAttribute("data-theme"),localStorage.removeItem("darkSwitch"))})}}();
