$('body').on('click.disableAdd', function(e) {
  // Check to see if the list is currently displayed.
  if ($('#foodB').hasClass('showElement')) {
    // If element clicked on is NOT one of the menu list items,
    // hide the menu list.
    if($(e.target).hasClass('mainB')){
      console.log("it does");
    }

    if (!$(e.target).parent().hasClass('buttonParent') && !$(e.target).parent().parent().hasClass('buttonParent')) {
      console.log("clicked non" + $(e.target).attr('class'));
      $('#foodB').removeClass('showElement');
      $('#mainB').removeClass('hideElement');
      $('#exerciseB').removeClass('animated fadeInUp faster');
      $('#exerciseB').addClass('animated fadeOutDown faster');
    } else {
      console.log("clicked child")
    }
  }
});

$('#mainB').on('click', function() {
  $('#exerciseB').removeClass('animated fadeOutDown disableButton faster');
  $('#exerciseB').addClass('animated fadeInUp faster');
  $('#foodB').addClass('showElement');
  $('#mainB').addClass('hideElement');
  console.log("switched");
});

$('#listFoods').on('click', function() {
  $('#mainPage').removeClass('showElement');
  $('#mainPage').addClass('hideElement');
  $('#foodsPage').removeClass('hideElement');
  $('#foodsPage').addClass('showElement');
});

$('#backB').on('click', function() {
  $('#foodsPage').removeClass('showElement');
  $('#foodsPage').addClass('hideElement');
  $('#mainPage').removeClass('hideElement');
  $('#mainPage').addClass('showElement');
});

$('#foodB').on('click', function() {
  $('#mainPage').removeClass('showElement');
  $('#mainPage').addClass('hideElement');
  $('#addFoodPage').removeClass('hideElement');
  $('#addFoodPage').addClass('showElement');
});

$('#backBAdd').on('click', function() {
  $('#addFoodPage').removeClass('showElement');
  $('#addFoodPage').addClass('hideElement');
  $('#mainPage').removeClass('hideElement');
  $('#mainPage').addClass('showElement');
});

$('#editB').on('click', function() {
  $('.delItem').toggleClass('showElement');
  $('.delItem').toggleClass('hideElement');
});
