
<!-- Modal -->
<div class="modal fade" id="addApartment" tabindex="-1" role="dialog" aria-labelledby="addApartment" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title custom_modal_title" id="addApartment">Add Apartment to database</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/apartments/add" method="post" class="row">
                    @csrf
                <div class="form-group">
                    <label for="map">Map</label>
                    <div id="map"></div>
                </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" id="latbox" name="lat"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Logitude</label>
                        <input type="text" id="lngbox" name="lng"  class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes <i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Madrid
            var madrid = {lat: 40.41, lng:-3.703};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 4, center: madrid});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: madrid,
                draggable: true,
                map: map});
        }

        google.map.event.addListener(marker, 'click', function (event) {
            document.getElementById("latbox").value ='hello';
            document.getElementById("lngbox").value = event.latLng.lng();
        });
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKk_0rwfVne-lIuMGNt4bQyYVMTcK7B54
&callback=initMap">
    </script>
</div>