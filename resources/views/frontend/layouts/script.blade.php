<!-- Latest jQuery -->
<script src="{{asset('/')}}frontend/assets/js/jquery-3.7.0.min.js"></script>
<!-- jquery-ui -->
<script src="{{asset('/')}}frontend/assets/js/jquery-ui.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- owl-carousel min js  -->
<script src="{{asset('/')}}frontend/assets/owlcarousel/js/owl.carousel.min.js"></script>
<!-- magnific-popup min js  -->
<script src="{{asset('/')}}frontend/assets/js/magnific-popup.min.js"></script>
<!-- waypoints min js  -->
<script src="{{asset('/')}}frontend/assets/js/waypoints.min.js"></script>
<!-- parallax js  -->
<script src="{{asset('/')}}frontend/assets/js/parallax.js"></script>
<!-- countdown js  -->
<script src="{{asset('/')}}frontend/assets/js/jquery.countdown.min.js"></script>
<!-- imagesloaded js -->
<script src="{{asset('/')}}frontend/assets/js/imagesloaded.pkgd.min.js"></script>
<!-- isotope min js -->
<script src="{{asset('/')}}frontend/assets/js/isotope.min.js"></script>
<!-- jquery.dd.min js -->
<script src="{{asset('/')}}frontend/assets/js/jquery.dd.min.js"></script>
<!-- slick js -->
<script src="{{asset('/')}}frontend/assets/js/slick.min.js"></script>
<!-- elevatezoom js -->
<script src="{{asset('/')}}frontend/assets/js/jquery.elevatezoom.js"></script>
<!-- scripts js -->
<script src="{{asset('/')}}frontend/assets/js/scripts.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106310707-1"></script>

{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
<script>
$(document).ready(function() {
    $(document).on('click', '#pagination-links a', function(e) {
        e.preventDefault();

        let url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                // ধরে নিচ্ছি সার্ভার থেকে পুরো ব্লেড রিটার্ন করবে যার মধ্যে টেবিল + pagination রয়েছে
                // তুমি চাইলে কন্টেইনার আলাদা করেও করতে পারো
                $('#orders-container').html($(data).find('#orders-container').html());
                $('#pagination-links').html($(data).find('#pagination-links').html());

                // যদি তোমার পেজের অন্য কিছু আপডেট করতে হয় এখানে করতে পারো
            },
            error: function() {
                alert('Something went wrong. Please try again.');
            }
        });
    });
});
</script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
 gtag('config', 'UA-106310707-1', { 'anonymize_ip': true });
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G6MPNF0KNC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G6MPNF0KNC');
</script>


<!-- Hotjar Tracking Code for bestwebcreator.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2073024,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<!-- Start of StatCounter Code -->
<script>
	// var sc_project=11921154; var sc_security="6c07f98b";
	// 	var scJsHost = (("https:" == document.location.protocol) ?
	// 	"https://secure." : "http://www.");
document.write("<sc"+"ript src='" +scJsHost +"statcounter.com/counter/counter.js'></"+"script>");
</script>


<script>
    $('#add_cart_form').submit(function(e) {
        e.preventDefault();

        let color = $('#product-color').val();
        let size = $('#product-size').val();

        if (!color || !size) {
            toastr.warning('Please select color and size.');
            return false;
        }

        var url = $(this).attr('action');
        var request = $(this).serialize();

        $('.loading').removeClass('d-none');

        $.ajax({
            url: url,
            type: 'POST',
            data: request,
            success: function(data) {
                toastr.options = {
                    "positionClass": "toast-top-right",
                    "zIndex": 99999
                };

                if (data.status === 'success') {
                    toastr.success(data.message);
                    $('#add_cart_form')[0].reset();

                    // ✅ Close modal and fix screen freeze
                    $('#quickviewModal').modal('hide');

                    setTimeout(function () {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('body').css('overflow', 'auto'); // ✅ unlock scrolling
                    }, 500);

                    updateCart();
                } else {
                    toastr.error(data.message || 'Something went wrong!');
                }

                $('.loading').addClass('d-none');
            },
            error: function() {
                toastr.error('Something went wrong!');
                $('.loading').addClass('d-none');
            }
        });
    });

    function updateCart() {
        $.ajax({
            url: '{{ route("cart.items") }}',
            type: 'GET',
            success: function(data) {
                $('#cart-count').text(data.cartCount);

                // Only update the inner price, not the whole <p>
                $('#cart-total .cart_price').html(
                    '<span class="price_symbole">{{ $setting->currency }}</span>' + data.subtotal
                );

                $('#cart-list').empty();

                $.each(data.cartItems, function(index, item) {
                    $('#cart-list').append(
                        `<li id="cart-item-${item.rowId}">
                            <a href="javascript:void(0);" class="item_remove remove-cart-item" data-id="${item.rowId}">
                                <i class="ion-close"></i>
                            </a>
                            <a href="#">
                                <img src="{{ asset('') }}${item.options.thumbnail}" alt="cart_thumb">
                                ${item.name.substring(0, 20)}...
                            </a>
                            <span class="cart_quantity">
                                ${item.qty} x
                                <span class="cart_amount">
                                    <span class="price_symbole">{{ $setting->currency }}</span>${item.price}
                                </span>
                            </span>
                        </li>`
                    );
                });
            },
            error: function() {
                toastr.error('Failed to update cart.');
         }
        });
    }

  $(document).on('click', '.remove-cart-item', function(e) {
      e.preventDefault(); // Prevent the default action of the anchor tag

      let cartItemId = $(this).data('id'); // Get the ID of the cart item

      $.ajax({
          url: '/cart/remove/' + cartItemId,
          type: 'DELETE', // Ensure your route supports DELETE method
          data: {
              _token: '{{ csrf_token() }}', // CSRF token for security
          },
          success: function(data) {
              if (data.success) {
                  toastr.success(data.message);
                  $('#cart-item-' + cartItemId).remove(); // Remove the item from the DOM
                  updateCart();
                  updateCartTable(data.cart); // Call the function to update cart count and total
              }
          }
      });
  });

    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();

        var button = $(this);
        var id = button.data('id');
        var price = button.data('price');
        var color = button.data('color');
        var size = button.data('size');
        var qty = button.data('qty');

        $.ajax({
            url: "{{ route('add.to.cart.quickview') }}", // Or your actual Add-to-Cart route
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                price: price,
                color: color,
                size: size,
                qty: qty
            },
            beforeSend: function () {
                button.prop('disabled', true).text('Adding...');
            },
            success: function (data) {
                toastr.success(data.message);
                updateCart(); // refresh the mini cart
            },
            complete: function () {
                button.prop('disabled', false).html('<i class="icon-basket-loaded"></i> Add To Cart');
            }
        });
    });

    //update cart table
    function updateCartTable(cart) {
        let tbody = '';
        let sum = 0;
            $.each(cart, function (key, product) {
                sum += product.subtotal;
                tbody += `
                    <tr>
                        <td class="product-thumbnail"><a href="#"><img src="${product.options.thumbnail}" alt="img"></a></td>
                        <td class="product-name" data-title="Product"><a href="#" target="_blank">${product.name}</a></td>
                        <td class="product-price" data-title="Price">${product.price}</td>
                        <td class="product-quantity" data-title="Quantity">
                            <div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input type="number" name="data[${key}][qty]" value="${product.qty}" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                            </div>
                        </td>
                        <td class="product-subtotal" data-title="Total">${product.subtotal}</td>
                        <td class="product-remove" data-title="Remove">
                            <a href="javascript:void(0);" class="item_remove remove-cart-item" data-id="${product.rowId}">
                                <i class="ti-close"></i>
                            </a>
                        </td>
                    </tr>`;
            });
        $('tbody').html(tbody);
        // Update any other elements, such as the total sum, if necessary
    }

</script>

<script>
    // Color select
    $(document).on('click', '.product_color_switch span', function () {
        $('.product_color_switch span').removeClass('active');
        $(this).addClass('active');
        $('#product-color').val($(this).data('color'));
    });

    // Size select
    $(document).on('click', '.product_size_switch span', function () {
        $('.product_size_switch span').removeClass('active');
        $(this).addClass('active');
        $('#product-size').val($(this).text());
    });
</script>


<script>
    // Live Suggestion AJAX
    $(document).ready(function () {
        $('#search_input').on('keyup', function () {
            let query = $(this).val();
            if (query.length > 1) {
                $.ajax({
                    url: "{{ route('ajax.search') }}",
                    method: "GET",
                    data: { query: query },
                    success: function (data) {
                        $('#search_result').fadeIn().html(data);
                    }
                });
            } else {
                $('#search_result').fadeOut();
            }
        });

        // Click outside to hide suggestion
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#search_input, #search_result').length) {
                $('#search_result').fadeOut();
            }
        });
    });

    // Redirect to SEO-friendly result page
    function redirectSearchURL(event) {
        event.preventDefault();
        let keyword = document.getElementById('search_input').value.trim();
        if (keyword.length > 0) {
            window.location.href = "/search-result/" + encodeURIComponent(keyword);
        }
        return false;
    }
</script>

<script>
    function addToCompare(productId) {
        console.log("Clicked product ID:", productId); // test

        axios.get(`/add-to-compare/${productId}`)
            .then(function (response) {
                console.log(response.data); // test
                const data = response.data;
                if(data.status === 'success') {
                    toastr.success(data.message);
                } else if(data.status === 'warning') {
                    toastr.warning(data.message);
                } else {
                    toastr.error('Unexpected response from server.');
                }
            })
            .catch(function (error) {
                console.error(error); // test
                toastr.error('Failed to add product to compare.');
            });
        }
</script>

<script>
    $(document).on('click', '.remove-from-compare', function (e) {
        e.preventDefault();

        let productId = $(this).data('id');

        $.ajax({
            url: '/compare/remove/' + productId,
            type: 'GET',
            success: function (response) {
                if (response.status === 'success') {
                    toastr.success(response.message);

                    // Remove all <td> related to the product across rows
                    $('td[data-product-id="' + productId + '"]').remove();

                    // If no products left in table
                    if ($('td[data-product-id]').length === 0) {
                        $('#compareTable').remove();
                        $('#compare-empty-msg').removeClass('d-none');
                    }

                } else {
                    toastr.error(response.message);
                }
            },
            error: function () {
                toastr.error('Something went wrong!');
            }
        });
    });
</script>


<script>
    $(document).on('click', '.wishlist-remove-btn', function () {
        var itemId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this item from your wishlist?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('wishlist.remove') }}", // example route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: itemId
                    },
                    success: function (response) {
                        Swal.fire('Removed!', response.message, 'success');
                        // Optionally remove row from DOM
                        location.reload(); // or use $('#row-' + itemId).remove();
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong!', 'error');
                    }
                });
            }
        });
    });
</script>
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>



<script src="{{asset('/')}}admin/assets/js/plugins/sweetalert2.all.min.js"></script>
<script src="{{ asset('/') }}frontend/assets/js/script.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- End of StatCounter Code -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

