Website: Thời trang công sở

Hướng dẫn cài đặt:
	Bước 1: Clone project về máy
		(git clone https://github.com/hoangbug/Office_Fashion_LARAVEL.git)

	Bước 2: - Mở project (PhpStorm, Visual Studio Code, Sublime text, ...)
		- Tạo file .env
		- Mở file .env.example copy toàn bộ file vào file .env
		- Cấu hình thêm 1 số thông tin tại file .env như:
			DB_CONNECTION=mysql
			DB_HOST=127.0.0.1
			DB_PORT=3306
			DB_DATABASE=
			DB_USERNAME=
			DB_PASSWORD=

			BROADCAST_DRIVER=log
			CACHE_DRIVER=redis
			QUEUE_CONNECTION=database
			SESSION_DRIVER=file
			SESSION_LIFETIME=120

			REDIS_HOST=127.0.0.1
			REDIS_PASSWORD=null
			REDIS_PORT=6379
			REDIS_CLIENT=predis

			# Integrated email sending
			MAIL_DRIVER=smtp
			MAIL_HOST=smtp.gmail.com
			MAIL_PORT=587
			MAIL_USERNAME=
			MAIL_PASSWORD=
			MAIL_ENCRYPTION=
			MAIL_FROM_ADDRESS=
			MAIL_FROM_NAME=

			# Integrate nexmo to send messages to your phone
			NEXMO_KEY=
			NEXMO_SECRET=

			# Vnpay payment integration
			VNP_TMN_CODE=Y4U88XFK
			VNP_HASH_SECRET=DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV
			VNP_URL=http://sandbox.vnpayment.vn/paymentv2/vpcpay.html

	Bước 3: Chạy lệnh: composer update --no-scripts
			   composer dump-autoload
		(Để cài đặt và load các package tại vendor)

	Bước 4: Mở phpmyadmin tạo project
		Chạy lệnh: php artisan migrate

	Bước 5: Chạy lệnh: php artisan key:generate để tạo APP_KEY

	Bước 6: Chạy lệnh: php artisan serve
	
	Bước 7: Chạy mở project với đường dẫn http://127.0.0.1:8000/

	Chú ý: - Có thể dùng seeder để factories dữ kiệu faker
	       - Khi bắt đầu insert dữ liệu vào database mà có image thì các bạn chạy lệnh: php artisan storage:link để link image vào public
           - Chạy lệnh php artisan db:seed --class=DetailProductSeeder để seeder các product
           - Chạy seeder xong bạn hãy tạo tài khoản và đăng nhập vào admin
           (Cập nhật số lượng sản phẩm vào dữ liệu seeder) 
	       - Khi thanh toán xong chạy lệnh: php artisan queue:work --tries=3 để gửi mail và tin nhắn điện thoại khi đặt hàng thành công
            ( Phần gửi tin nhắn về điện thoại mình chỉ demo nếu bạn có tài khoản Nexmo thì thêm key trong file .env và fix lại số điện thoại trong App\Jobs\SendMailCheckout.php)

	.....



