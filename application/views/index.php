<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo isset($this->text['title']) ? $this->text['title'] : TITLE; ?></title>
        <style>
            html, body {
                background-color: #f0f0f0;
                font-family: 'Arial';
            }
            
            .box {
                background-color: #fefefe;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
                margin: 10px auto;
            }
            
            strong {
                font-size: 18px;
                color: #555;
            }
            
            small {
                font-size: 16px;
                color: #888;
            }
        </style>
    </head>
    <body>

        <div class="box">
            <strong>PHP Framework</strong>
            <small>By Junior Miranda</small>
        </div>
        
    </body>
</html>