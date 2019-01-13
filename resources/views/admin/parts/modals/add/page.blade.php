<!-- Modal -->
<div class="modal fade" id="addStaticPage" tabindex="-1" role="dialog" aria-labelledby="addStaticPage" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header page_add_header">
                <h5 class="modal-title add_page_title_modal" id="exampleModalLabel">Add Page &nbsp;<i class="fas fa-plus-square"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/pages/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-5 mt-4">
                        <div class="col-md-5 ">
                            <div class=" form-group mt-2">
                            <label for="title" class="label_add_page">Title</label>
                            <input type="text" id="title_post" class="form-control" placeholder="..." autocomplete="off" required name="title">
                            </div>
                            <div class="form-group  mt-4 mb-4">
                                <label for="url_slug" class="label_add_page">Enter content to  generatea slug</label>
                                <input type="text" class="form-control"  id="url_rewrite" required name="slug" autocomplete="off">
                            </div>
                            <div class="form-group mt-2 mb-4">
                                <label for="image" class="label_add_page">Image</label>
                                <div class="file-upload">
                                    <div class="file-select">
                                        <div class="file-select-button"  id="fileName">Choose File</div>
                                        <div class="file-select-name"  id="noFile">No file chosen...</div>
                                        <input type="file" name="image" id="chooseFile">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 ml-3" >
                            <p class="label_add_page">Choose a parent Category</p>

                            <select id="slick_categories" name="parent_category"  required></select>
                            <div class="form-group mt-3 ml-1">
                                <label for="content" class="label_add_page">Content</label>
                                <textarea cols="20" rows="10" class="form-control wysiwyg" name="page_content" placeholder="..."   ></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/ddslick.js')}}"></script>
<script>
            @php
                $categories=\App\Blog::all()
            @endphp
    var ddData=[
                    @foreach($categories as $category)
            {
                text: "{{$category->name}}",
                value:{{$category->id}},
                selected: false,
                description:"{!! str_limit($category->content,200,'...')!!}",
                    @if($category->image)
                    imageSrc: "{{asset("storage/pages_image/$category->image")}}"
                    @endif
            },
                @endforeach
        ];

    $('#slick_categories').ddslick({
        data: ddData,
        width: 300,
        imagePosition: "right",
        selectText: "Select Parent Category",
        onSelected: function (data) {

        }
    });
</script>
<script>
    function convertToSlug(Text)
    {
        return Text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            ;
    }
    $("#title_post").keypress(function() {
        setTimeout(function(){
            $("#url_rewrite").val(convertToSlug($("#title_post").val()));
        },500);

    });
</script>
