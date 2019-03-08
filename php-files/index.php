<?

$path = ltrim($_SERVER['REQUEST_URI'], '/');
$elements = explode('/', $path);

if(empty($elements[0])) {
    include "home.php";
} else switch(array_shift($elements)){
    
    
    case 'glycemic-index':
        include 'home.php';
        break;
    case 'glycemic-index-foods':
        include 'home.php';
        break;
    case 'glycemic-index-table':
        include 'home.php';
        break;
    case 'glycemic-index-chart':
        include 'home.php';
        break;
    case 'complete-glycemic-index-foods':
        include 'home.php';
        break;
        
    case 'what-is-glycemic-index':
        include 'what.php';
        break;
    case 'high-glycemic-foods':
        include 'high.php';
        break;
    case 'low-glycemic-foods':
        include 'low.php';
        break;
    case 'medium-glycemic-foods':
        include 'medium.php';
        break;
    case 'zero-glycemic-foods':
        include 'zero.php';
        break;
        
    case 'advertise':
        include 'advertise.php'; break;

    case 'bookmark-us':
        include 'bookmark.php'; break;
        
    case 'about':
        include 'about.php'; break;
        
    case 'contact':
        include 'contact.php'; break;

    case 'terms-and-use':
        include 'terms.php'; break;
    
    case 'privacy-policy':
        include 'privacy.php'; break;
        
    case 'search':
        if (empty($elements[1])){
            $tag = $_POST['q'];
        } else {
            $tag = array_shift($elements);
        }
        include 'search.php';
        break;

    case 'category':
        $tag = array_shift($elements);
        include 'category.php';
        break;

    case 'glycemic-foods-starts-with':
        $tag = array_shift($elements);
        include 'letter.php';
        break;

    case 'food':
        $tag = array_shift($elements);
        include 'food.php';
        break;
        
    case 'similar-glycemic_index':
        $tag = array_shift($elements);
        include 'similar.php';
        break;
        
    case '6547382374637':
        include 'login-6547382374637.php';
        break;  
    case 'logout':
        include 'logout.php';
        break;
        
    case 'sitemap.xml':
        include 'sitemap.php';
        break;

    case 'yandex_0fb5fdcacf689163.html':
        include 'yandex_0fb5fdcacf689163.html';
        break;

    default:
        header('HTTP/1.1 404 Not Found');
}
?>