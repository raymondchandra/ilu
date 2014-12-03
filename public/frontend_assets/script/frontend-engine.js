/**
 * Front-End created by Yohanes Mario Chandra (http://yohanesmario.com)
 */

if (typeof($)=="undefined") {
    console.error("THIS ENGINE NEEDS JQUERY TO WORK.");
}

const PQP = {
    
    //INIT
    init: function(done) {
        Number.prototype.formatMoney = function(c, d, t){
            var n = this, 
            c = isNaN(c = Math.abs(c)) ? 2 : c, 
            d = d == undefined ? "." : d, 
            t = t == undefined ? "," : t, 
            s = n < 0 ? "-" : "", 
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
            j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };
        
        var root = this;
        
        if (typeof(done)!="function") {
            done = function(){};
        }
        
        this.engine.handlerURL = $("#urls > #handler").html()+"/index.php";
        this.graphics.templateURL = $("#urls > #template").html();
        this.graphics.assetsURL = $("#urls > #assets").html();
        
        root.graphics.renderTemplate(function(){
            root.graphics.renderHash(done);
        });
        
        root.debug();
    },
    
    //ENGINE
    engine: {
        //HANDLER URL
        handlerURL: "handle.php",
        
        //LOGIN
        login: function(usr,pwd) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/login",
                data: {
                    username:usr,
                    password:pwd
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //LOGOUT
        logout: function() {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/logout",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //REGISTER
        register: function(username,password,no_ktp,full_name,name_in_profile,dob,email,company_name,company_address,address,city,country,province,postal,company,phone,mobile) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"register",
                data: {
                    username:username,
                    password:password,
                    no_ktp:no_ktp,
                    full_name:full_name,
                    name_in_profile:name_in_profile,
                    dob:dob,
                    email:email,
                    company_name:company_name,
                    company_address:company_address,
                    address:address,
                    city:city,
                    country:country,
                    province:province,
                    postal:postal,
                    company:company,
                    phone:phone, //ARRAY OF STRINGS
                    mobile:mobile //ARRAY OF STRINGS
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //FORGOT PASS
        forgotPass: function(email) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/forgotPass",
                data: {
                    email:email
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET PRODUCT BY ID
        getProductById: function(id) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/product/"+id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET PRODUCT BY CATEGORY
        getProductByCategory: function(category_id,by,page,limit) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/product/category/"+category_id,
                data: {
                    by:by,
                    page:page,
                    limit:limit
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET PRODUCT BY NAME
        getProductByName: function(name,by,page,limit) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/product/name/"+name,
                data: {
                    by:by,
                    page:page,
                    limit:limit
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET TOP PRODUCT
        getTopProduct: function(by,page,limit) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/product/top",
                data: {
                    by:by,
                    page:page,
                    limit:limit
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET NEW PRODUCT
        getNewProduct: function(by,page,limit,success,fail) {
            /*
            var result = {
                product : {
                    "name" : "TEST",
                    description : "TEST TEST TEST",
                    category : "TEST_CATEGORY"
                },
                attribute : [
                    {
                        attr_name : "A",
                        attr_value : "Value of A",
                        price : 100000,
                        tax : 0.1
                    }
                ],
                promo : {
                    amount : 0.5,
                    expired : "2014-03-26 10:10:10"
                },
                wishlist : true,
                cart : true
            };
            
            if (typeof(success)=="function"){
                success();
            }
            */
            
            ///*
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/product/new",
                data: {
                    by:by,
                    page:page,
                    limit:limit
                },
                success: function(data) {
                    if (typeof(success)=="function"){
                        if (data.code=="200") {
                            success(data.messages);
                        } else {
                            fail();
                        }
                    }
                },
                error:function() {
                    alert("fail_internal");
                    if (typeof(fail)=="function"){
                        fail();
                    }
                }
            });
            //*/
        },
        
        //GET RANDOM PRODUCT
        getRandomProduct: function(by,page,limit) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/product/random",
                data: {
                    by:by,
                    page:page,
                    limit:limit
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //COMPARE
        compare: function(id) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/compare",
                data: {
                    id:id //ARRAY OF INT
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET CATEGORY
        getCategory: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/category",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET SLIDESHOW
        getSlideshow: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/slideshow",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET NEWS
        getNews: function(page,limit) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/news",
                data: {
                    page:page,
                    limit:limit
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET NEWS
        getNews: function(page,limit) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/news",
                data: {
                    page:page,
                    limit:limit
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET NEWS BY ID
        getNewsById: function(id) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/news/"+id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //SEND MESSAGE
        sendMessage: function(name,email,subject,text) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/message",
                data: {
                    name:name,
                    email:email,
                    subject:subject,
                    text:text
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET INFORMATION
        getInformation: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/information",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET INFORMATION BY ID
        getInformationById: function(id) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/information/"+id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET INFORMATION BY ID
        getInformationById: function(id) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/information/"+id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET CONTACT
        getContact: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/contact",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //SET PASSWORD
        setPassword: function(oldPassword,newPassword,reNewPassword) {
            $.ajax({
                type: "PUT",
                url: this.handlerURL+"/user/password",
                data: {
                    oldPassword:oldPassword,
                    newPassword:newPassword,
                    reNewPassword:reNewPassword
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET PROFILE
        getProfile: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/user/profile",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //SET PROFILE
        setProfile: function(no_ktp,full_name,name_in_profile,dob,email,company_name,company_address,address,city,country,province,postal,company,phone,mobile) {
            $.ajax({
                type: "PUT",
                url: this.handlerURL+"/user/profile",
                data: {
                    no_ktp:no_ktp,
                    full_name:full_name,
                    name_in_profile:name_in_profile,
                    dob:dob,
                    email:email,
                    company_name:company_name,
                    company_address:company_address,
                    address:address,
                    city:city,
                    country:country,
                    province:province,
                    postal:postal,
                    company:company,
                    phone:phone, //ARRAY OF STRINGS
                    mobile:mobile //ARRAY OF STRINGS
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //ADD ADDRESS
        addAddress: function(address,city,country,province,postal,company,phone) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/address",
                data: {
                    address:address,
                    city:city,
                    country:country,
                    province:province,
                    postal:postal,
                    company:company,
                    phone:phone //ARRAY OF STRINGS
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //SET ADDRESS
        setAddress: function(id,address,city,country,province,postal,company,phone) {
            $.ajax({
                type: "PUT",
                url: this.handlerURL+"/user/address/"+id,
                data: {
                    address:address,
                    city:city,
                    country:country,
                    province:province,
                    postal:postal,
                    company:company,
                    phone:phone //ARRAY OF STRINGS
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //DELETE ADDRESS
        deleteAddress: function(id) {
            $.ajax({
                type: "DELETE",
                url: this.handlerURL+"/user/address/"+id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET WISHLIST
        getWishlist: function(page) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/user/wishlist",
                data: {
                    page:page
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //ADD WISHLIST
        addWishlist: function(product_id) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/wishlist",
                data: {
                    product_id:product_id
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //DELETE WISHLIST
        deleteWishlist: function(id) {
            $.ajax({
                type: "DELETE",
                url: this.handlerURL+"/user/wishlist/"+id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET ATTRIBUTE
        getAttribute: function(product_id) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/user/wishlist/"+product_id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //ADD CART
        addCart: function(id,cls,quantity) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/cart",
                data: {
                    id:id,
                    "class":cls,
                    quantity:quantity
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //SET CART
        setCart: function(id,cls) {
            $.ajax({
                type: "PUT",
                url: this.handlerURL+"/user/cart",
                data: {
                    id:id,
                    "class":cls
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //SET CART QUANTITY
        setCartQuantity: function(id,quantity) {
            $.ajax({
                type: "PUT",
                url: this.handlerURL+"/user/cart/quantity",
                data: {
                    id:id,
                    quantity:quantity
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //DELETE CART
        deleteCart: function(id) {
            $.ajax({
                type: "DELETE",
                url: this.handlerURL+"/user/cart/"+id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //CHECK VOUCHER
        checkVoucher: function(voucher_code) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/checkVoucher",
                data: {
                    voucher_code:voucher_code
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET ORDER
        getOrder: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/user/order",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //ADD ORDER
        addOrder: function(cart_id,voucher_id,shipment,total_price) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/order",
                data: {
                    cart_id:cart_id,
                    voucher_id:voucher_id,
                    shipment:shipment,
                    total_price:total_price
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET BANK
        getBank: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/user/bank",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET SHIPMENT
        getShipment: function() {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/user/shipment",
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //ADD PAYMENT
        addPayment: function(invoice,paid_amt,full_name,bank_id,payment,source_bank,bank_acc_owner,bank_acc_number) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/payment",
                data: {
                    invoice : invoice,
                    paid_amt : paid_amt,
                    full_name : full_name,
                    bank_id : bank_id,
                    payment : payment,
                    source_bank : source_bank,
                    bank_acc_owner : bank_acc_owner,
                    bank_acc_number : bank_acc_number
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //GET REVIEW
        getReview: function(product_id) {
            $.ajax({
                type: "GET",
                url: this.handlerURL+"/user/review/"+product_id,
                data: {},
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        },
        
        //ADD REVIEW
        addReview: function(product_id,text,rating) {
            $.ajax({
                type: "POST",
                url: this.handlerURL+"/user/review",
                data: {
                    product_id:product_id,
                    text:text,
                    rating:rating
                },
                success: function(data) {
                    //TO-DO
                },
                fail:function(data) {
                    //TO-DO
                }
            });
        }
    },
    
    //GRAPHICS
    graphics: {
        templateURL:"/html/template.html",
        
        //RENDER LOGIN
        renderLogin: function(done){
            $("#login-box").show(1000,function(){
                if (typeof(done)=="function") {
                    done();
                }
            });
        },
        
        //RENDER TEMPLATE
        renderTemplate: function(done){
            $.ajax({
                type: "GET",
                url: this.templateURL,
                data: {},
                success: function(data) {
                    data = data.replace(/\{\{assets\}\}/g, $("#urls > #assets").html());
                    $("#body").html(data);
                    if (typeof(done)=="function") {
                        done();
                    }
                },
                fail:function(data) {
                    
                }
            });
        },
        
        renderHash: function(done){
            var hash = $.url().attr("anchor").split("/");
            
            if (hash[0]=="!" && hash.length>=2) {
                switch(hash[1]) {
                    case "product":
                        alert("product");
                        break;
                    case "category":
                        alert("category");
                        break;
                    default:
                        this.jumpToHome(done);
                        break;
                }
            } else {
                this.jumpToHome(done);
            }
        },
        
        jumpToHome: function(done){
            var root = this;
            $("#content > div > [id!='sidebar']").remove();
            $("#content > div").append($("#template > #home > *"));
            this.PARENT.engine.getNewProduct(1,0,1,function(data){
                //SUCCESS
                console.log(data);
                $("#newest > .products").html("");
                $.each(data,function(index,value){
                    var cloned = $("#template > .product").clone();
                    cloned.children(".product-name").html(value.name);
                    if (value.main_photo=="") {
                        cloned.children("img").attr("src", root.assetsURL+"/resource/produk-unavailable.jpg");
                    } else {
                        cloned.children("img").attr("src", value.main_photo);
                    }
                    if (value.prices.length>0) {
                        cloned.children(".product-price").children(".before").html("Rp"+value.prices[0].price_with_tax.formatMoney(2,',','.'));
                        cloned.children(".product-price").children(".after").html("Rp"+value.prices[0].price_with_tax_promotion.formatMoney(2,',','.'));
                    }
                    if (index%3==0 && index!=0) {
                        $("#newest > .products").append("<div class='clear'></div>");
                    }
                    $("#newest > .products").append(cloned);
                });
            },function(data){
                //FAIL
                alert("Failed to retrieve products data.");
            });
            root.renderSlideshow([
                $("#urls > #assets").html()+"/resource/slideshow/daftarmemberparahyangan.jpg",
                $("#urls > #assets").html()+"/resource/slideshow/slidekartunamablue.jpg",
                $("#urls > #assets").html()+"/resource/slideshow/slidekomunitas.jpg",
                $("#urls > #assets").html()+"/resource/slideshow/slideparahyangan2.jpg",
                $("#urls > #assets").html()+"/resource/slideshow/slideparahyangan3.jpg",
                $("#urls > #assets").html()+"/resource/slideshow/slideparahyanganshippment.jpg"
            ], function(){
                root.renderCart(done);
            });
        },
        
        //RENDER SLIDESHOW
        renderSlideshow: function(image_path,done){
            if (typeof(image_path)=="object" && (image_path instanceof Array)) {
                var content = '<div id="slides">';
                $.each(image_path,function(index,value){
                    content += '<img src="'+value+'">';
                });
                content += '</div>';
                if ($("#content #slideshow").length>0) {
                    $("#content #slideshow").empty();
                } else {
                    $("#content > div").prepend($("#template > #slideshow"));
                }
                $("#content #slideshow").html(content);
                $(function(){
                    $("#slides").slidesjs({
                        width: 1170,
                        height: 480,
                        play: {
                            active: true,
                            auto: true,
                            interval: 4000,
                            swap: true,
                            pauseOnHover: true,
                            restartDelay: 2500
                        },
                        effect: {
                            slide: {
                                speed: 1000
                            }
                        }
                    });
                });
            }
            if (typeof(done)=="function") {
                done();
            }
        },
        
        //RENDER CART
        renderCart: function(done) {
            
            if (typeof(done)=="function") {
                done();
            }
        },
        
        //CLEAR CONTAINER
        clearContainer: function(container,done) {
            if(typeof(container)=="object" && typeof(container.jquery)=="string") {
                container.empty();
            }
            if (typeof(done)=="function") {
                done();
            }
        },
        
        //APPEND PRODUCT
        appendProduct: function(container,productData,done) {
            
            if (typeof(done)=="function") {
                done();
            }
        },
        
        //APPEND CATEGORY
        appendCategory: function(container,categoryData,done) {
            
            if (typeof(done)=="function") {
                done();
            }
        }
    },
    
    //DEBUG
    debug: function(){
        console.log(this);
    },
    
    
    
    //PRECONFIGURE
    preconfigure: function() {
        this.generateParentLink(this,this);
        delete this.preconfigure;
        delete this.generateParentLink;
        return this;
    },
    //GENERATE PARENT LINK
    generateParentLink: function(obj,root) {
        $.each(obj, function(index,value) {
            if (typeof(value)=="object") {
                root.generateParentLink(value,root);
                value.PARENT = obj;
            }
        });
    }
    
}.preconfigure();
