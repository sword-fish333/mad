<div class="newsletter">
    <div class="inliner">
        <p class="text_f_news">Subscribe to our newsletter to receive the best deals and promotions</p>
        <form action="/clients/newsletter" method="post" style="margin-left: 60px">
            @csrf
            <input type="text" class="inp_f_news " placeholder="Name..." name="name">

            <input type="email" class="inp_f_news" placeholder="Email..." name="email">
        <button type="submit" class="btn_f_news">Subscribe</button>
        </form>
    </div>
</div>