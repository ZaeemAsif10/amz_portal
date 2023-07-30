@extends('setup.web-master')

@section('title', 'Products')

@section('content-web')

    <style>
        article {
            --img-scale: 1.001;
            --title-color: black;
            --link-icon-translate: -20px;
            --link-icon-opacity: 0;
            position: relative;
            border-radius: 16px;
            box-shadow: none;
            background: #fff;
            transform-origin: center;
            transition: all 0.4s ease-in-out;
            overflow: hidden;
        }

        article a::after {
            position: absolute;
            inset-block: 0;
            inset-inline: 0;
            cursor: pointer;
            content: "";
        }

        /* basic article elements styling */
        article h2 {
            margin: 0 0 18px 0;
            font-family: "Bebas Neue", cursive;
            font-size: 1.9rem;
            letter-spacing: 0.06em;
            color: var(--title-color);
            transition: color 0.3s ease-out;
        }

        figure {
            margin: 0;
            padding: 0;
            aspect-ratio: 16 / 9;
            /* overflow: hidden; */
        }

        article img {
            max-width: 50%;
            transform-origin: center;
            transform: scale(var(--img-scale));
            transition: transform 0.4s ease-in-out;
        }

        .article-body {
            padding: 24px;
        }

        article a {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #28666e;
        }

        article a:focus {
            outline: 1px dotted #28666e;
        }

        article a .icon {
            min-width: 24px;
            width: 24px;
            height: 24px;
            margin-left: 5px;
            transform: translateX(var(--link-icon-translate));
            opacity: var(--link-icon-opacity);
            transition: all 0.3s;
        }

        /* using the has() relational pseudo selector to update our custom properties */
        article:has(:hover, :focus) {
            --img-scale: 1.1;
            --title-color: #28666e;
            --link-icon-translate: 0;
            --link-icon-opacity: 1;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        }


        /************************
                        Generic layout (demo looks)
                        **************************/

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 48px 0;
            font-family: "Figtree", sans-serif;
            /* font-size: 1.2rem; */
            line-height: 1.6rem;
            background-image: linear-gradient(45deg, #7c9885, #b5b682);
            min-height: 100vh;
        }

        .articles {
            margin-top: 3rem;
            display: grid;
            max-width: 1200px;
            margin-inline: auto;
            padding-inline: 24px;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        @media screen and (max-width: 960px) {
            article {
                container: card/inline-size;
            }

            .article-body p {
                display: none;
            }
        }

        @container card (min-width: 380px) {
            .article-wrapper {
                display: grid;
                grid-template-columns: 100px 1fr;
                gap: 16px;
            }

            .article-body {
                padding-left: 0;
            }

            figure {
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            figure img {
                height: 100%;
                aspect-ratio: 1;
                object-fit: cover;
            }
        }

        .sr-only:not(:focus):not(:active) {
            clip: rect(0 0 0 0);
            clip-path: inset(50%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .article-wrapper h4.card-text {
            color: #555;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
    </style>


    <div class="container" style="margin-top: 4rem;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form action="{{ url('buyer') }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="keyword" class="form-control" placeholder="keyword...">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="product_no" class="form-control"
                                    placeholder="Search by product ID...">
                            </div>

                            <div class="col-md-2">
                                <select name="market" class="form-control">
                                    <option value="" selected disabled>Select Market</option>
                                    <option value="US">US</option>
                                    <option value="UK">UK</option>
                                    <option value="DE">DE</option>
                                    <option value="IT">IT</option>
                                    <option value="CA">CA</option>
                                    <option value="ES">ES</option>
                                    <option value="AUS">AUS</option>
                                    <option value="JAPAN">JAPAN</option>
                                    <option value="KSA">KSA</option>
                                    <option value="UAE">UAE</option>
                                    <option value="General">General</option>
                                    <option value="Maxico">Maxico</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Netherland">Netherland</option>
                                    <option value="Us-High-Commission">Us-High-Commission</option>
                                    <option value="Uk-High-Commission">Uk-High-Commission</option>
                                    <option value="Walmart-US">Walmart-US</option>
                                    <option value="Turkey">Turkey</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="prod_type" class="form-control">
                                    <option value="" selected disabled>Select type</option>
                                    <option value="Review">Review</option>
                                    <option value="Top Reviwer">Top Reviwer</option>
                                    <option value="No Review">No Review</option>
                                    <option value="Feedback">Feedback</option>
                                    <option value="Rating">Rating</option>
                                    <option value="RAS">RAS</option>
                                    <option value="RAO">RAO</option>
                                    <option value="Seller Testing">Seller Testing</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100" title="search">Serach</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <section class="articles">

        @isset($data['products'])
            @foreach ($data['products'] as $product)
                <article>
                    <div class="article-wrapper">
                        <figure class="text-center mt-3">
                            <img src="{{ asset('public/uploads/image/' . $product->image) }}" alt="" />
                        </figure>
                        <div class="article-body">
                            <h4 class="card-text">{{ $product->keyword }} </h4>
                            <span>
                                <strong>Product ID:</strong> {{ $product->product_no ?? '' }}
                            </span>
                            <br>
                            <span>
                                {{ $product->tot_remaining ?? '' }} daily sale limit / {{ $product->tot_sale ?? '' }} Total
                                sale limit
                            </span>
                            <h4 class="mt-3">{{ $product->market ?? '' }}</h4>
                        </div>
                    </div>
                </article>
            @endforeach
        @endisset


    </section>

    <div class="float-right mt-3 mr-3">
        {{ $data['products']->links('pagination::bootstrap-4') }}
    </div>

@endsection
