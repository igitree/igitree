<!DOCTYPE html>
<html>
  <head> 
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    
    <link rel="shortcut icon" href="./common/favicon/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="./common/favicon/icon-16.png" sizes="16x16" />
    <link rel="icon" href="./common/favicon/icon-32.png" sizes="32x32" />
    <link rel="icon" href="./common/favicon/icon-48.png" sizes="48x48" />
    <link rel="icon" href="./common/favicon/icon-96.png" sizes="96x96" />
    <link rel="icon" href="./common/favicon/icon-144.png" sizes="144x144" />
    <!-- end meta block -->
    <script type="text/javascript" src="{{asset('js/newTree/codebase/diagram.js?v=4.1.0')}}"></script>
    <link rel="stylesheet" href="{{asset('js/newTree/codebase/diagram.css?v=4.1.0')}}">
    <link rel="stylesheet" href="{{asset('js/newTree/index.css?v=4.1.0')}}">
    <!-- icons -->
    <link href="https://cdn.materialdesignicons.com/4.5.95/css/materialdesignicons.min.css?v=4.1.0" media="all" rel="stylesheet" type="text/css">
    <!-- Suite GPL -->
    <script src="https://cdn.dhtmlx.com/suite/edge/suite.js?v=4.1.0"></script>
    <link rel="stylesheet" href="https://cdn.dhtmlx.com/suite/edge/suite.css?v=4.1.0">
    <!-- custom sample head -->{{-- 
    <script type="text/javascript" src="{{asset('js/newTree/data.js?v=4.1.0')}}"></script> --}}
    <style>
      html, body, .dhx_diagram {
        background: #fff;
      }
      .main__container {
        height: calc(100% - 121px);
        display: flex;
      }
      .sample__container {
        height: 100%;
        width: calc(100% - 248px);
        overflow: auto;
      }
      .dhx_sample-controls {
        background: #fff;
      }
      .dhx_sample-slider__container {
        width: 350px;
      }
      .template {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        color: rgba(0, 0, 0, 0.7);
        border: 1px solid #DFDFDF;
        padding: 10px 12px;
        cursor: pointer;
      }
      .template span {
        display: flex;
      }
      .template h3, .template p {
        text-align: left;
        font-size: 14px;
        line-height: 20px;
        height: 20px;
        margin: 0 0 4px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      .template .template_container {
        height: 100%;
        width: 100%;
        overflow: hidden;
        position: relative;
      }
      .template .template_img-container {
        min-width: 93px;
        width: 93px;
        margin-right: 12px;
      }
      .template .template_img-container-medium {
        min-width: 44px;
        width: 44px;
        margin-right: 12px;
      }
      .template .template_img-container img, .template_img-container-medium img {
        width: inherit;
        height: auto;
      }
      .dhx_selected .template {
        outline: 2px solid #8c8c8c;
      }
      .sidebar__container {
        min-width: 248px;
        width: 248px;
        height: 100%;
        background: #fff;
        border-left: 1px solid #DFDFDF;
        padding: 20px;
        display: flex;
        flex-direction: column;
      }
      .sidebar__container a {
        display: block;
        text-align: center;
        text-decoration: none;
        width: 100%;
        height: 28px;
        line-height: 28px;
        color: #fff;
        background: #0288D1;
        border-radius: 14px;
        margin-top: 28px;
      }
      .sidebar__container span {
        font-size: 14px;
        line-height: 20px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        color: rgba(0, 0, 0, 0.7);
        padding: 4px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      .sidebar__container img {
        height: 208px;
        width: auto;
        background: #8c8c8c;
        margin-bottom: 28px;
      }
    </style>
  </head>
  <body>
    <header class="dhx_sample-header">
      <div class="dhx_sample-header__main">
        {{-- <nav class="dhx_sample-header__breadcrumbs">
          <ul class="dhx_sample-header-breadcrumbs">
            <li class="dhx_sample-header-breadcrumbs__item">
              <a href="./index.html" class="dhx_sample-header-breadcrumbs__link">Back to Diagram samples</a>
            </li>
          </ul>
        </nav> --}}
       {{--  <h1 class="dhx_sample-header__title">
          <div class="dhx_sample-header__content">
            Diagram in org chart mode. Template change while zooming
          </div>
        </h1> --}}
      </div>
    </header>
    <section class="dhx_sample-controls">
      <div class="dhx_sample-slider__container" id="slider"></div>
    </section>
    <section class="main__container">
      <div class="sample__container" id="diagram"></div>
      <div class="sidebar__container">
        <img id="image" src="" alt="">
        <span id="title" style="font-weight:500">title</span>
        <span id="post">Post</span>
        <span id="phone">Phone</span>
        <span id="mail" style="color:#0288D1">Mail</span>
        <a id="add" class="btn btn-sm btn-default" href="" target="_blank">Add Relatives</a>
      </div>
    </section>
    <script>
      const medical_workers=<?php echo$data ?>;
      console.log(medical_workers);
      const tickTemplate = value => value;

      const slider = new dhx.Slider("slider", {
        min: 0.4,
        max: 1,
        tooltip: false,
        step: 0.05,
        tick: 1,
        majorTick: 2,
        value: 0.7,
        tickTemplate: tickTemplate
      });

      let diagram;

      function largeTemplate(config) {
        let template = '<section class="template">';
          template += '<div class="template_container template_img-container">';
          template += '<img src="'+ config.photo +'" alt="'+ config.title + "-" + config.post +'"></img>';
          template += '</div>';
          template += '<div class="template_container">';
          template += '<h3>'+ config.title +'</h3>';
          template += '<p>'+ config.post +'</p>';
          template += '<span>';
          template += '<p>'+ config.phone +'</p>';
          template += '</span>';
          template += '<span>';
          template += '<a style="color:#0288D1" href="mailto:'+ config.mail +'" target="_blank">'+ config.mail +'</a> ';
          template += '</span></div>';
          template += '</section>';
        return template;
      }

      function mediumTemplate(config) {
        let template = '<section class="template">';
          template += '<div class="template_container template_img-container-medium">';
          template += '<img src="'+ config.photo +'" alt="'+ config.title + "-" + config.post +'"></img>';
          template += '</div>';
          template += '<div class="template_container">';
          template += '<h3>'+ config.title +'</h3>';
          template += '<p>'+ config.post +'</p>';
          template += '</div>';
          template += '</section>';
        return template;
      }

      function smallTemplate(config) {
        let template = '<section class="template">';
          template += '<div class="template_container">';
          template += '<h3>'+ config.title +'</h3>';
          template += '</div>';
          template += '</section>';
        return template;
      }

      const largeDefaults = {
        width: 330,
        height: 115
      };

      const mediumDefaults = {
        width: 200,
        height: 68
      };

      const smallDefaults = {
        width: 200,
        height: 44
      };

      let person;

      function getInfo(person) {
        const image = document.querySelector("#image");
        const title = document.querySelector("#title");
        const post = document.querySelector("#post");
        const phone = document.querySelector("#phone");
        const mail = document.querySelector("#mail");
        const add = document.querySelector("#add");

        title.innerHTML = person.title + "";
        post.innerHTML = person.post + "";
        phone.innerHTML = person.phone + "";
        mail.innerHTML = person.mail + "";
        add.href = "/tree/view/" + person.mail + "/add/member";
        image.src = person.img + "";
        image.alt = person.title + "-" + person.post + "";
      }

      function createDiagram(config) {
        diagram = new dhx.Diagram("diagram", {
          type: "org",
          defaultShapeType: "template",
          scale: config.scale
        });

        diagram.addShape("template", {
          template: config.template,
          defaults: config.defaults
        });

        medical_workers.forEach(function(item) {
          item.width = config.defaults.width;
          item.height = config.defaults.height;
        });

        diagram.data.parse(medical_workers);

        diagram.events.on("ShapeClick", function(id) {
          diagram.selection.add(id);
          person = diagram.data.getItem(id);

          getInfo({
            title: person.title,
            post: person.post, 
            mail: person.mail,
            img: person.photo,
          });
        });
      }

      function changeTemplate(scale) {
        const selectionItem = diagram.selection.getItem();
        if (diagram) {
          diagram.destructor();
        }
        switch (true) {
          case scale >= 0.8:
            createDiagram({
              defaults: largeDefaults,
              template: largeTemplate,
              scale: scale
            });
            break;
          case scale <= 0.8 && scale >= 0.6:
            createDiagram({
              defaults: mediumDefaults,
              template: mediumTemplate,
              scale: scale
            });
            break;
          case scale <= 0.6:
            createDiagram({
              defaults: smallDefaults,
              template: smallTemplate,
              scale: scale
            });
            break;
        }
        diagram.selection.add(selectionItem.id);
      }

      slider.events.on("change", function(value) {
        changeTemplate(value);
      });

      createDiagram({
        defaults: mediumDefaults,
        template: mediumTemplate,
        scale: 0.7
      });

      diagram.selection.add("main");

      person = diagram.data.getItem("main");

      getInfo({
        title: person.title,
        post: person.post,
        phone: person.phone,
        mail: person.mail,
        img: person.photo,
      });
    </script>
  </body>
</html>
