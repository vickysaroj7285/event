<script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-event-set-component@5/dist/aframe-event-set-component.min.js"></script>
    <script src="https://unpkg.com/aframe-layout-component@5.3.0/dist/aframe-layout-component.min.js"></script>
    <script src="https://unpkg.com/aframe-template-component@3.2.1/dist/aframe-template-component.min.js"></script>
    <script src="https://unpkg.com/aframe-proxy-event-component@2.1.0/dist/aframe-proxy-event-component.min.js"></script>
  



<a-scene>
      <a-assets>
        <img id="city" crossorigin="anonymous" src="https://4.imimg.com/data4/NK/NM/MY-9511949/360-degree-view-photography-500x500.jpg">
      
      </a-assets>

      <!-- 360-degree image. -->
      <a-sky id="image-360" radius="10" src="#city"
             animation__fade="property: components.material.material.color; type: color; from: #FFF; to: #000; dur: 300; startEvents: fade"
             animation__fadeback="property: components.material.material.color; type: color; from: #000; to: #FFF; dur: 300; startEvents: animationcomplete__fade"></a-sky>

      
      <!-- Camera + cursor. -->
      <a-entity camera look-controls>
        <a-cursor
          id="cursor"
          animation__click="property: scale; startEvents: click; from: 0.1 0.1 0.1; to: 1 1 1; dur: 150"
          animation__fusing="property: fusing; startEvents: fusing; from: 1 1 1; to: 0.1 0.1 0.1; dur: 1500"
          event-set__mouseenter="_event: mouseenter; color: springgreen"
          event-set__mouseleave="_event: mouseleave; color: black"
          raycaster="objects: .link"></a-cursor>
      </a-entity>
    </a-scene>