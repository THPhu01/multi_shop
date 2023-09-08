@extends('client.layout')

@section('contentMain')
    <div class="row px-xl-5 cart-container justify-content-center">
        <div class="col-lg-10 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark initialism">
                    <tr>
                        <th>Ảnh Sản phẩm</th>
                        <th>Tên Sản phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>

                <tbody class="align-middle" id="show-wishlist">

                </tbody>


            </table>

            <div class="d-flex justify-content-end mt-4">
                <button onclick="deleteCartItems()" class="btn btn-primary initialism mr-2">Xóa toàn bộ yêu thích</button>
            </div>
        </div>

    </div>
    <div class="cart-null"></div>
    <script>
        function formatCurrency(number) {
            // Convert number to string
            var strNumber = number.toString();

            // Split the number into whole and decimal parts
            var parts = strNumber.split('.');
            var wholePart = parts[0];
            var decimalPart = parts.length > 1 ? parts[1] : '';

            // Add commas every three digits in the whole part
            var formattedWholePart = '';
            var digitCount = 0;
            for (var i = wholePart.length - 1; i >= 0; i--) {
                formattedWholePart = wholePart.charAt(i) + formattedWholePart;
                digitCount++;
                if (digitCount === 3 && i > 0) {
                    formattedWholePart = '.' + formattedWholePart;
                    digitCount = 0;
                }
            }

            // Combine the formatted whole and decimal parts
            var formattedNumber = formattedWholePart;
            if (decimalPart !== '') {
                formattedNumber += '.' + decimalPart;
            }

            // Add the VNĐ symbol
            formattedNumber += 'đ';

            return formattedNumber;
        }
    </script>
    {{-- Show wishlist --}}
    <script>
        view_wishlist()

        function view_wishlist() {
            if (localStorage.getItem('data') != null) {

                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                var countWishlist = data.length;
                let html = "";
                for (i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].name;
                    var price = data[i].price;
                    var price_sale = data[i].price_sale;
                    var image = data[i].image;
                    var linkimage = data[i].linkimage;
                    var url = data[i].url;
                    if (Number.parseInt(price_sale) > 0) {
                        $('#show-wishlist').append(
                            ' <tr><td class="align-middle"><img style="width: 60px;" src="' + linkimage +
                            '"></td><td class="align-middle"><a href="' + url +
                            '"class="wishlist-a decoration-none">' + name +
                            ' </a></td><td class="align-middle"> <span style="color:red">' +
                            formatCurrency(price_sale) + '</span><del style="font-size: 14px;"> ' +
                            formatCurrency(price) +
                            '</td><td class="align-middle"><div class="d-flex justify-content-around"><button class="btn btn-sm btn-success add-to-cart" data-id_product="' +
                            id +
                            '" ><i class="fas fa-shopping-cart"></i></button><button class="btn btn-sm btn-danger delete_wishlist" data-id="' +
                            id +
                            '" style="margin-top:0"><i class="fa fa-times"></i></button></div></td></tr><input type="hidden" value="' +
                            price_sale + '" class="cart_product_price_sale_' + id + '"><input type="hidden" value="' +
                            price + '" class="cart_product_price_' + id +
                            '"><input type="hidden" value="1" class="cart_product_qty_' + id +
                            '"><input type="hidden" value="' + name + '" class="cart_product_name_' + id +
                            '"><input type="hidden" value="' + image + '" class="cart_product_image_' + id +
                            '"><input type="hidden" value="' + id + '" class="cart_product_id_' + id + '">');
                        $('#wishlist-count').html(countWishlist);
                    } else {
                        $('#show-wishlist').append(
                            ' <tr><td class="align-middle"><img style="width: 60px;" src="' + linkimage +
                            '"></td><td class="align-middle"><a href="' + url +
                            '"class="wishlist-a decoration-none">' + name +
                            ' </a></td><td class="align-middle">' +
                            formatCurrency(price) +
                            '</td><td class="align-middle"><div class="d-flex justify-content-around"><button class="btn btn-sm btn-success add-to-cart" data-id_product="' +
                            id +
                            '"><i class="fas fa-shopping-cart"></i></button><button class="btn btn-sm btn-danger delete_wishlist" data-id="' +
                            id + '" ><i class="fa fa-times"></i></button></div></td></tr><input type="hidden" value="' +
                            price_sale + '" class="cart_product_price_sale_' + id + '"><input type="hidden" value="' +
                            price + '" class="cart_product_price_' + id +
                            '"><input type="hidden" value="1" class="cart_product_qty_' + id +
                            '"><input type="hidden" value="' + name + '" class="cart_product_name_' + id +
                            '"><input type="hidden" value="' + image + '" class="cart_product_image_' + id +
                            '"><input type="hidden" value="' + id + '" class="cart_product_id_' + id + '">');
                        $('#wishlist-count').html(countWishlist);

                    }

                }
            }
        }
    </script>
    {{-- Xóa wishlist --}}
    <script>
        $(document).on('click', '.delete_wishlist', function(event) {
            event.preventDefault(); // những hành động mặc định của sự kiện sẽ k xảy ra
            var id = $(this).data('id');

            // console.log(localStorage.getItem('data'));
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));
                if (data.length) {
                    for (i = 0; i < data.length; i++) {
                        if (data[i].id == id) {
                            data.splice(i, 1); //xóa phần tử khỏi mảng, tham số thứ 2 là 1 phần tử
                            toastr.success('Xóa yêu thích thành công!')
                        }
                    }
                }

                localStorage.setItem('data', JSON.stringify(data)); //chuyển obj->string
                window.setTimeout(function() {
                    window.location.reload();
                }, 500);
            }
        });

        function deleteCartItems() {
            if (localStorage.getItem('data') != null) {
                window.localStorage.clear();
                toastr.success('Xóa yêu thích thành công!')
                window.setTimeout(function() {
                    window.location.reload();
                }, 500);
            }
        }
    </script>
@endsection
