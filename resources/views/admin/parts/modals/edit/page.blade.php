<!-- Modal -->
<div class="modal fade" id="editPage{{$page->id}}" tabindex="-1" role="dialog" aria-labelledby="addStaticPage" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header page_add_header">
                <h5 class="modal-title add_page_title_modal" id="exampleModalLabel">Edit Page &nbsp;<i class="fas fa-highlighter"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/pages/edit/{{$page->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-5 mt-4">
                        <div class="col-md-5 ">
                            <div class=" form-group mt-2">
                            <label for="title" class="label_add_page">Title</label>
                            <input type="text" id="title_post{{$page->id}}" class="form-control" autocomplete="off" value="{{$page->name}}" placeholder="..."  name="title">
                            </div>
                            <div class="form-group  mt-4 mb-4">
                                <label for="url_slug" class="label_add_page">Enter content to  generatea slug</label>
                                <input type="text" id="url_rewrite{{$page->id}}" autocomplete="off" class="form-control"  value="{{$page->url_rewrite}}"  name="slug">
                            </div>
                            <div class="form-group mt-2 mb-4">
                                <p class="label_add_page">Current Image</p>
                                <img src="{{asset("storage/pages_image/$page->image")}}" class="img-thumbnail" style="width: 150px; height: auto;">
                              <div>
                                <label for="title" class="label_add_page">Choose a new Image if you want</label>

                                          <input type="file" name="image" class="form-control">

                              </div>
                            </div>
                        </div>
                        <div class=" col-md-6" >
                            <p class="label_add_page">Choose a new parent Category <strong>(Optional)</strong></p>

                            <select id="slick_categories{{$page->id}}" name="parent_category"  ></select>
                            <div class="form-group mt-3 ml-1">
                                <label for="content" class="label_add_page">Content</label>
                                <textarea cols="20" rows="15" class="form-control wysiwyg" placeholder="..."  name="page_content">{{$page->content}}</textarea>
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
                selected:false,
                description: "{!!str_limit($category->content,200,'...')!!}",
                    @if($category->image)
                    imageSrc: "{{asset("storage/pages_image/$category->image")}}"
                    @endif
            },
                @endforeach
        ];

    $('#slick_categories{{$page->id}}').ddslick({
        data: ddData,
        width: 300,
        imagePosition: "right",
        defaultSelectedIndex:{{$page->parent_id}}-1,
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
    $("#title_post{{$page->id}}").keypress(function() {
        setTimeout(function(){
            $("#url_rewrite{{$page->id}}").val(convertToSlug($("#title_post{{$page->id}}").val()));
        },500);

    });
</script>