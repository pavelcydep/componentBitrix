function handler( event ) {
  var target = $( event.target );
  if ( target.is( "li" ) ) {
    target.children().toggle();
  }
}
$( "ul" ).click( handler ).find( "ul" ).hide();
