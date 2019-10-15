<?php
require 'config.php';
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/login','login'); /* User login */
$app->post('/signup','signup'); /* User Signup  */
$app->get('/getFeed','getFeed'); /* User Feeds  */
$app->post('/feed','feed'); /* User Feeds  */
$app->post('/feedUpdate','feedUpdate'); /* User Feeds  */
$app->post('/feedDelete','feedDelete'); /* User Feeds  */
$app->post('/getImages', 'getImages');

$app->post('/addUser', 'addUser');
$app->post('/addItem', 'addItem');
$app->post('/addToCart', 'addToCart');
$app->post('/addShop', 'addShop');
$app->post('/addCartToBill', 'addCartToBill');
$app->post('/addCartToBill2', 'addCartToBill2');

$app->post('/getAllShop', 'getAllShop');
$app->post('/getUserByUsername', 'getUserByUsername');
$app->post('/getFoodById', 'getFoodById');
$app->post('/getUserById', 'getUserById');
$app->post('/getCartById', 'getCartById');
$app->post('/getOrderById', 'getOrderById');
$app->post('/getDetailBillById', 'getDetailBillById');

$app->run();

/************************* USER LOGIN *************************************/
/* ### User login ### */
function getUserById()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id = $data;
    try {
        $userData = array();
        $sql_query = "SELECT * from users where user_id=$id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql_query);
        $userData = $rst->fetchAll(PDO::FETCH_OBJ);
        $userData = json_encode($userData);
        echo '{"data": '.$userData.'}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function getUserByUsername()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $username = $data;

    try {
        $userData = array();
        $sql_query = 'SELECT * from users where username=$username';
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql_query);
        $userData = $rst->fetchAll(PDO::FETCH_OBJ);

        $userData = json_encode($userData);
        echo '{"data": '.$userData.'}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function addCartToBill2()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $address = $data->address;
    // $time = $data->time;
    // $landmark = $data->landmark;
    // $pricesum = $data->pricesum;
    // $totalsum = $data->totalsum;
    // $user_id = $data->user_id;
    // $shop_id = $data->shop_id;
    

    try {
        $sql1 = "INSERT INTO bill-detail ()
        VALUES('')";
        // $sql1 = "INSERT INTO bill-detail (address,time,landmark,pricesum,totalsum,user_id,shop_id)
        //     VALUES('$address','$time','$landmark','$pricesum','$totalsum','$user_id','$shop_id')";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql1);
        echo '{ "sucess": "insert"}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function addCartToBill()
{
    $request = \Slim\Slim::getInstance()->request();
    $bill = json_decode($request->getBody());
    $address = $bill->address;
    $time = $bill->time;
    $landmark = $bill->landmark;
    $name = $bill->name;
    $price = $bill->price;
    $picture = $bill->picture;
    $total = $bill->total;
    $pricesum = $bill->pricesum;
    $shop_id = $bill->shop_id;
    $user_id = $bill->user_id;
    $item_id = $bill->item_id;
    $totalsum = $bill->totalsum;

    try {
        $sql1 = "INSERT INTO bill (address,time,landmark,name,price,
        picture,total,pricesum,shop_id,user_id,item_id)
            VALUES('$address','$time','$landmark','$name','$price',
            '$picture','$total','$pricesum','$shop_id','$user_id','$item_id')";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql1);
        echo '{ "sucess": "insert"}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function getDetailBillById()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id = $data;
    try {
        $userData = array();
        $sql_query = "SELECT * from bill where user_id=$id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql_query);
        $userData = $rst->fetchAll(PDO::FETCH_OBJ);
        $userData = json_encode($userData);
        echo '{"data": '.$userData.'}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function getAllShop()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    // $id = $data;

    try {
        $userData = array();
        $sql_query = 'SELECT * from shop ';
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql_query);
        $userData = $rst->fetchAll(PDO::FETCH_OBJ);

        $userData = json_encode($userData);
        echo '{"data": '.$userData.'}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function getOrderById()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id = $data;
    try {
        $userData = array();
        $sql_query = "SELECT * from cart where user_id=$id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql_query);
        $userData = $rst->fetchAll(PDO::FETCH_OBJ);
        $userData = json_encode($userData);
        echo '{"data": '.$userData.'}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function getCartById()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id = $data;
    try {
        $userData = array();
        $sql_query = "SELECT * from cart where user_id=$id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql_query);
        $userData = $rst->fetchAll(PDO::FETCH_OBJ);
        $userData = json_encode($userData);
        echo '{"data": '.$userData.'}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function getFoodById()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id = $data;
    try {
        $userData = array();
        $sql_query = "SELECT * from item where shop_id=$id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql_query);
        $userData = $rst->fetchAll(PDO::FETCH_OBJ);
        $userData = json_encode($userData);
        echo '{"data": '.$userData.'}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function addToCart()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $item_id = $data->item_id;
    $name = $data->name;
    $price = $data->price;
    $picture = $data->picture;
  
    try {
        $sql1 = "INSERT INTO cart (item_id,price,picture,name)
            VALUES('$item_id','$price','$picture','$name')";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql1);
        echo '{ "sucess": "insert"}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function addShop()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $name = $data->name;
    $type = $data->type;
    $tel = $data->tel;
    $picture = $data->picture;
  
    try {
        $sql1 = "INSERT INTO shop (name,type,tel,picture)
            VALUES('$name','$type','$tel','$picture')";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql1);
        echo '{ "sucess": "insert"}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function addItem()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $name = $data->name;
    $price = $data->price;
    $picture = $data->picture;
    $shop_id = $data->shop_id;
  
    try {
        $sql1 = "INSERT INTO item (name,price,picture,shop_id)
            VALUES('$name','$price','$picture','$shop_id')";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql1);
        echo '{ "sucess": "insert"}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function addUser()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $username = $data->username;
    $password = $data->password;
    $name = $data->name;
    $email = $data->email;
    $tel = $data->tel;
  
    try {
        $sql1 = "INSERT INTO users (username,password,name,email,tel)
            VALUES('$username','$password','$name','$email','$tel')";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst = $conn->query($sql1);
        echo '{ "sucess": "insert"}';
    } catch (PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
}
function login() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    try {
        
        $db = getDB();
        $userData ='';
        $sql = "SELECT user_id, name, email, username FROM users WHERE (username=:username or email=:username) and password=:password ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $data->username, PDO::PARAM_STR);
        $password=hash('sha256',$data->password);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $userData = $stmt->fetch(PDO::FETCH_OBJ);
        
        if(!empty($userData))
        {
            $user_id=$userData->user_id;
            $userData->token = apiToken($user_id);
        }
        
        $db = null;
         if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            } else {
               echo '{"error":{"text":"Bad request wrong username and password"}}';
            }

           
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### User registration ### */
function signup() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $email=$data->email;
    $name=$data->name;
    $username=$data->username;
    $password=$data->password;
    
    try {
        
        $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
        $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
        $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);
        
        echo $email_check.'<br/>'.$email;
        
        if (strlen(trim($username))>0 && strlen(trim($password))>0 && strlen(trim($email))>0 && $email_check>0 && $username_check>0 && $password_check>0)
        {
            echo 'here';
            $db = getDB();
            $userData = '';
            $sql = "SELECT user_id FROM users WHERE username=:username or email=:email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $username,PDO::PARAM_STR);
            $stmt->bindParam("email", $email,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                
                /*Inserting user values*/
                $sql1="INSERT INTO users(username,password,email,name)VALUES(:username,:password,:email,:name)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("username", $username,PDO::PARAM_STR);
                $password=hash('sha256',$data->password);
                $stmt1->bindParam("password", $password,PDO::PARAM_STR);
                $stmt1->bindParam("email", $email,PDO::PARAM_STR);
                $stmt1->bindParam("name", $name,PDO::PARAM_STR);
                $stmt1->execute();
                
                $userData=internalUserDetails($email);
                
            }
            
            $db = null;
         

            if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            } else {
               echo '{"error":{"text":"Enter valid data"}}';
            }

           
        }
        else{
            echo '{"error":{"text":"Enter valid data"}}';
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function email() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $email=$data->email;

    try {
       
        $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
       
        if (strlen(trim($email))>0 && $email_check>0)
        {
            $db = getDB();
            $userData = '';
            $sql = "SELECT user_id FROM emailUsers WHERE email=:email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("email", $email,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                
                /*Inserting user values*/
                $sql1="INSERT INTO emailUsers(email)VALUES(:email)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("email", $email,PDO::PARAM_STR);
                $stmt1->execute();
                
                
            }
            $userData=internalEmailDetails($email);
            $db = null;
            if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            } else {
               echo '{"error":{"text":"Enter valid dataaaa"}}';
            }
        }
        else{
            echo '{"error":{"text":"Enter valid data"}}';
        }
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### internal Username Details ### */
function internalUserDetails($input) {
    
    try {
        $db = getDB();
        $sql = "SELECT user_id, name, email, username FROM users WHERE username=:input or email=:input";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("input", $input,PDO::PARAM_STR);
        $stmt->execute();
        $usernameDetails = $stmt->fetch(PDO::FETCH_OBJ);
        $usernameDetails->token = apiToken($usernameDetails->user_id);
        $db = null;
        return $usernameDetails;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

function getFeed(){
  
   
    try {
         
        if(1){
            $feedData = '';
            $db = getDB();
          
                $sql = "SELECT * FROM feed  ORDER BY feed_id DESC LIMIT 15";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("user_id", $user_id, PDO::PARAM_INT);
                $stmt->bindParam("lastCreated", $lastCreated, PDO::PARAM_STR);
          
            $stmt->execute();
            $feedData = $stmt->fetchAll(PDO::FETCH_OBJ);
           
            $db = null;

            if($feedData)
            echo '{"feedData": ' . json_encode($feedData) . '}';
            else
            echo '{"feedData": ""}';
        } else{
            echo '{"error":{"text":"No access"}}';
        }
       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

function feed(){
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $user_id=$data->user_id;
    $token=$data->token;
    $lastCreated = $data->lastCreated;
    $systemToken=apiToken($user_id);
   
    try {
         
        if($systemToken == $token){
            $feedData = '';
            $db = getDB();
            if($lastCreated){
                $sql = "SELECT * FROM feed WHERE user_id_fk=:user_id AND created < :lastCreated ORDER BY feed_id DESC LIMIT 5";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("user_id", $user_id, PDO::PARAM_INT);
                $stmt->bindParam("lastCreated", $lastCreated, PDO::PARAM_STR);
            }
            else{
                $sql = "SELECT * FROM feed WHERE user_id_fk=:user_id ORDER BY feed_id DESC LIMIT 5";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("user_id", $user_id, PDO::PARAM_INT);
            }
            $stmt->execute();
            $feedData = $stmt->fetchAll(PDO::FETCH_OBJ);
           
            $db = null;

            if($feedData)
            echo '{"feedData": ' . json_encode($feedData) . '}';
            else
            echo '{"feedData": ""}';
        } else{
            echo '{"error":{"text":"No access"}}';
        }
       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

function feedUpdate(){

    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $user_id=$data->user_id;
    $token=$data->token;
    $feed=$data->feed;
    
    $systemToken=apiToken($user_id);
   
    try {
         
        if($systemToken == $token){
         
            
            $feedData = '';
            $db = getDB();
            $sql = "INSERT INTO feed ( feed, created, user_id_fk) VALUES (:feed,:created,:user_id)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("feed", $feed, PDO::PARAM_STR);
            $stmt->bindParam("user_id", $user_id, PDO::PARAM_INT);
            $created = time();
            $stmt->bindParam("created", $created, PDO::PARAM_INT);
            $stmt->execute();
            


            $sql1 = "SELECT * FROM feed WHERE user_id_fk=:user_id ORDER BY feed_id DESC LIMIT 1";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("user_id", $user_id, PDO::PARAM_INT);
            $stmt1->execute();
            $feedData = $stmt1->fetch(PDO::FETCH_OBJ);


            $db = null;
            echo '{"feedData": ' . json_encode($feedData) . '}';
        } else{
            echo '{"error":{"text":"No access"}}';
        }
       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}



function feedDelete(){
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $user_id=$data->user_id;
    $token=$data->token;
    $feed_id=$data->feed_id;
    
    $systemToken=apiToken($user_id);
   
    try {
         
        if($systemToken == $token){
            $feedData = '';
            $db = getDB();
            $sql = "Delete FROM feed WHERE user_id_fk=:user_id AND feed_id=:feed_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam("feed_id", $feed_id, PDO::PARAM_INT);
            $stmt->execute();
            
           
            $db = null;
            echo '{"success":{"text":"Feed deleted"}}';
        } else{
            echo '{"error":{"text":"No access"}}';
        }
       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
    
}
$app->post('/userImage','userImage'); /* User Details */
function userImage(){
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $user_id=$data->user_id;
    $token=$data->token;
    $imageB64=$data->imageB64;
    $systemToken=apiToken($user_id);
    try {
        if(1){
            $db = getDB();
            $sql = "INSERT INTO imagesData(b64,user_id_fk) VALUES(:b64,:user_id)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam("b64", $imageB64, PDO::PARAM_STR);
            $stmt->execute();
            $db = null;
            echo '{"success":{"status":"uploaded"}}';
        } else{
            echo '{"error":{"text":"No access"}}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

$app->post('/getImages', 'getImages');
function getImages(){
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $user_id=$data->user_id;
    $token=$data->token;
    
    $systemToken=apiToken($user_id);
    try {
        if(1){
            $db = getDB();
            $sql = "SELECT b64 FROM imagesData";
            $stmt = $db->prepare($sql);
           
            $stmt->execute();
            $imageData = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"imageData": ' . json_encode($imageData) . '}';
        } else{
            echo '{"error":{"text":"No access"}}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
?>
