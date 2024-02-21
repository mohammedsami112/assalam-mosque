import{D as S,am as ee,al as N,L as z,h as T,B as x,cL as te,cM as ne,I as O,b as d,y as R,H,ae as A,d8 as U,ct as se,x as w,e as re,g as I,b5 as ie,b1 as ae,b6 as oe,X as D,bo as le,F as ue,ch as ce,Y as fe,K as de,c6 as ve,N as ge,c8 as me,O as he,P as ye,c9 as be,cb as Se,cA as _e,cr as we,R as xe,cC as Pe,V as Re,cF as pe,af as ze}from"./index-RVtWa1VN.js";class p{constructor(o){let{x:i,y:n,width:a,height:r}=o;this.x=i,this.y=n,this.width=a,this.height=r}get top(){return this.y}get bottom(){return this.y+this.height}get left(){return this.x}get right(){return this.x+this.width}}function Le(e,o){return{x:{before:Math.max(0,o.left-e.left),after:Math.max(0,e.right-o.right)},y:{before:Math.max(0,o.top-e.top),after:Math.max(0,e.bottom-o.bottom)}}}function Fe(e){return Array.isArray(e)?new p({x:e[0],y:e[1],width:0,height:0}):e.getBoundingClientRect()}function je(e){const o=e.getBoundingClientRect(),i=getComputedStyle(e),n=i.transform;if(n){let a,r,t,s,u;if(n.startsWith("matrix3d("))a=n.slice(9,-1).split(/, /),r=+a[0],t=+a[5],s=+a[12],u=+a[13];else if(n.startsWith("matrix("))a=n.slice(7,-1).split(/, /),r=+a[0],t=+a[3],s=+a[4],u=+a[5];else return new p(o);const f=i.transformOrigin,l=o.x-s-(1-r)*parseFloat(f),v=o.y-u-(1-t)*parseFloat(f.slice(f.indexOf(" ")+1)),h=r?o.width/r:e.offsetWidth+1,b=t?o.height/t:e.offsetHeight+1;return new p({x:l,y:v,width:h,height:b})}else return new p(o)}function De(e,o,i){if(typeof e.animate>"u")return{finished:Promise.resolve()};let n;try{n=e.animate(o,i)}catch{return{finished:Promise.resolve()}}return typeof n.finished>"u"&&(n.finished=new Promise(a=>{n.onfinish=()=>{a(n)}})),n}function Me(e){let o=arguments.length>1&&arguments[1]!==void 0?arguments[1]:"div",i=arguments.length>2?arguments[2]:void 0;return S()({name:i??ee(N(e.replace(/__/g,"-"))),props:{tag:{type:String,default:o},...z()},setup(n,a){let{slots:r}=a;return()=>{var t;return T(n.tag,{class:[e,n.class],style:n.style},(t=r.default)==null?void 0:t.call(r))}}})}const Ne="cubic-bezier(0.4, 0, 0.2, 1)",He="cubic-bezier(0.0, 0, 0.2, 1)",Ue="cubic-bezier(0.4, 0, 1, 1)";function Te(e){return{aspectStyles:R(()=>{const o=Number(e.aspectRatio);return o?{paddingBottom:String(1/o*100)+"%"}:void 0})}}const q=x({aspectRatio:[String,Number],contentClass:String,inline:Boolean,...z(),...te()},"VResponsive"),M=S()({name:"VResponsive",props:q(),setup(e,o){let{slots:i}=o;const{aspectStyles:n}=Te(e),{dimensionStyles:a}=ne(e);return O(()=>{var r;return d("div",{class:["v-responsive",{"v-responsive--inline":e.inline},e.class],style:[a.value,e.style]},[d("div",{class:"v-responsive__sizer",style:n.value},null),(r=i.additional)==null?void 0:r.call(i),i.default&&d("div",{class:["v-responsive__content",e.contentClass]},[i.default()])])}),{}}}),Be=x({transition:{type:[Boolean,String,Object],default:"fade-transition",validator:e=>e!==!0}},"transition"),P=(e,o)=>{let{slots:i}=o;const{transition:n,disabled:a,...r}=e,{component:t=A,...s}=typeof n=="object"?n:{};return T(t,H(typeof n=="string"?{name:a?"":n}:s,r,{disabled:a}),i)};function Ie(e,o){if(!U)return;const i=o.modifiers||{},n=o.value,{handler:a,options:r}=typeof n=="object"?n:{handler:n,options:{}},t=new IntersectionObserver(function(){var v;let s=arguments.length>0&&arguments[0]!==void 0?arguments[0]:[],u=arguments.length>1?arguments[1]:void 0;const f=(v=e._observe)==null?void 0:v[o.instance.$.uid];if(!f)return;const l=s.some(h=>h.isIntersecting);a&&(!i.quiet||f.init)&&(!i.once||l||f.init)&&a(l,s,u),l&&i.once?G(e,o):f.init=!0},r);e._observe=Object(e._observe),e._observe[o.instance.$.uid]={init:!1,observer:t},t.observe(e)}function G(e,o){var n;const i=(n=e._observe)==null?void 0:n[o.instance.$.uid];i&&(i.observer.unobserve(e),delete e._observe[o.instance.$.uid])}const Ve={mounted:Ie,unmounted:G},Ce=Ve,Oe=x({alt:String,cover:Boolean,draggable:{type:[Boolean,String],default:void 0},eager:Boolean,gradient:String,lazySrc:String,options:{type:Object,default:()=>({root:void 0,rootMargin:void 0,threshold:void 0})},sizes:String,src:{type:[String,Object],default:""},crossorigin:String,referrerpolicy:String,srcset:String,position:String,...q(),...z(),...Be()},"VImg"),Ae=S()({name:"VImg",directives:{intersect:Ce},props:Oe(),emits:{loadstart:e=>!0,load:e=>!0,error:e=>!0},setup(e,o){let{emit:i,slots:n}=o;const a=se("VImg"),r=w(""),t=re(),s=w(e.eager?"loading":"idle"),u=w(),f=w(),l=R(()=>e.src&&typeof e.src=="object"?{src:e.src.src,srcset:e.srcset||e.src.srcset,lazySrc:e.lazySrc||e.src.lazySrc,aspect:Number(e.aspectRatio||e.src.aspect||0)}:{src:e.src,srcset:e.srcset,lazySrc:e.lazySrc,aspect:Number(e.aspectRatio||0)}),v=R(()=>l.value.aspect||u.value/f.value||0);I(()=>e.src,()=>{h(s.value!=="idle")}),I(v,(c,g)=>{!c&&g&&t.value&&_(t.value)}),ie(()=>h());function h(c){if(!(e.eager&&c)&&!(U&&!c&&!e.eager)){if(s.value="loading",l.value.lazySrc){const g=new Image;g.src=l.value.lazySrc,_(g,null)}l.value.src&&ae(()=>{var g;i("loadstart",((g=t.value)==null?void 0:g.currentSrc)||l.value.src),setTimeout(()=>{var y;if(!a.isUnmounted)if((y=t.value)!=null&&y.complete){if(t.value.naturalWidth||W(),s.value==="error")return;v.value||_(t.value,null),s.value==="loading"&&b()}else v.value||_(t.value),$()})})}}function b(){var c;a.isUnmounted||($(),_(t.value),s.value="loaded",i("load",((c=t.value)==null?void 0:c.currentSrc)||l.value.src))}function W(){var c;a.isUnmounted||(s.value="error",i("error",((c=t.value)==null?void 0:c.currentSrc)||l.value.src))}function $(){const c=t.value;c&&(r.value=c.currentSrc||c.src)}let B=-1;oe(()=>{clearTimeout(B)});function _(c){let g=arguments.length>1&&arguments[1]!==void 0?arguments[1]:100;const y=()=>{if(clearTimeout(B),a.isUnmounted)return;const{naturalHeight:F,naturalWidth:j}=c;F||j?(u.value=j,f.value=F):!c.complete&&s.value==="loading"&&g!=null?B=window.setTimeout(y,g):(c.currentSrc.endsWith(".svg")||c.currentSrc.startsWith("data:image/svg+xml"))&&(u.value=1,f.value=1)};y()}const E=R(()=>({"v-img__img--cover":e.cover,"v-img__img--contain":!e.cover})),J=()=>{var y;if(!l.value.src||s.value==="idle")return null;const c=d("img",{class:["v-img__img",E.value],style:{objectPosition:e.position},src:l.value.src,srcset:l.value.srcset,alt:e.alt,crossorigin:e.crossorigin,referrerpolicy:e.referrerpolicy,draggable:e.draggable,sizes:e.sizes,ref:t,onLoad:b,onError:W},null),g=(y=n.sources)==null?void 0:y.call(n);return d(P,{transition:e.transition,appear:!0},{default:()=>[D(g?d("picture",{class:"v-img__picture"},[g,c]):c,[[fe,s.value==="loaded"]])]})},K=()=>d(P,{transition:e.transition},{default:()=>[l.value.lazySrc&&s.value!=="loaded"&&d("img",{class:["v-img__img","v-img__img--preload",E.value],style:{objectPosition:e.position},src:l.value.lazySrc,alt:e.alt,crossorigin:e.crossorigin,referrerpolicy:e.referrerpolicy,draggable:e.draggable},null)]}),Q=()=>n.placeholder?d(P,{transition:e.transition,appear:!0},{default:()=>[(s.value==="loading"||s.value==="error"&&!n.error)&&d("div",{class:"v-img__placeholder"},[n.placeholder()])]}):null,Z=()=>n.error?d(P,{transition:e.transition,appear:!0},{default:()=>[s.value==="error"&&d("div",{class:"v-img__error"},[n.error()])]}):null,k=()=>e.gradient?d("div",{class:"v-img__gradient",style:{backgroundImage:`linear-gradient(${e.gradient})`}},null):null,L=w(!1);{const c=I(v,g=>{g&&(requestAnimationFrame(()=>{requestAnimationFrame(()=>{L.value=!0})}),c())})}return O(()=>{const c=M.filterProps(e);return D(d(M,H({class:["v-img",{"v-img--booting":!L.value},e.class],style:[{width:ce(e.width==="auto"?u.value:e.width)},e.style]},c,{aspectRatio:v.value,"aria-label":e.alt,role:e.alt?"img":void 0}),{additional:()=>d(ue,null,[d(J,null,null),d(K,null,null),d(k,null,null),d(Q,null,null),d(Z,null,null)]),default:n.default}),[[le("intersect"),{handler:h,options:e.options},null,{once:!0}]])}),{currentSrc:r,image:t,state:s,naturalWidth:u,naturalHeight:f}}}),We=x({start:Boolean,end:Boolean,icon:de,image:String,text:String,...z(),...ve(),...ge(),...me(),...he(),...ye(),...be({variant:"flat"})},"VAvatar"),qe=S()({name:"VAvatar",props:We(),setup(e,o){let{slots:i}=o;const{themeClasses:n}=Se(e),{colorClasses:a,colorStyles:r,variantClasses:t}=_e(e),{densityClasses:s}=we(e),{roundedClasses:u}=xe(e),{sizeClasses:f,sizeStyles:l}=Pe(e);return O(()=>d(e.tag,{class:["v-avatar",{"v-avatar--start":e.start,"v-avatar--end":e.end},n.value,a.value,s.value,u.value,f.value,t.value,e.class],style:[r.value,l.value,e.style]},{default:()=>{var v;return[e.image?d(Ae,{key:"image",src:e.image,alt:"",cover:!0},null):e.icon?d(Re,{key:"icon",icon:e.icon},null):((v=i.default)==null?void 0:v.call(i))??e.text,pe(!1,"v-avatar")]}})),{}}}),$e=x({disabled:Boolean,group:Boolean,hideOnLeave:Boolean,leaveAbsolute:Boolean,mode:String,origin:String},"transition");function m(e,o,i){return S()({name:e,props:$e({mode:i,origin:o}),setup(n,a){let{slots:r}=a;const t={onBeforeEnter(s){n.origin&&(s.style.transformOrigin=n.origin)},onLeave(s){if(n.leaveAbsolute){const{offsetTop:u,offsetLeft:f,offsetWidth:l,offsetHeight:v}=s;s._transitionInitialStyles={position:s.style.position,top:s.style.top,left:s.style.left,width:s.style.width,height:s.style.height},s.style.position="absolute",s.style.top=`${u}px`,s.style.left=`${f}px`,s.style.width=`${l}px`,s.style.height=`${v}px`}n.hideOnLeave&&s.style.setProperty("display","none","important")},onAfterLeave(s){if(n.leaveAbsolute&&(s!=null&&s._transitionInitialStyles)){const{position:u,top:f,left:l,width:v,height:h}=s._transitionInitialStyles;delete s._transitionInitialStyles,s.style.position=u||"",s.style.top=f||"",s.style.left=l||"",s.style.width=v||"",s.style.height=h||""}}};return()=>{const s=n.group?ze:A;return T(s,{name:n.disabled?"":e,css:!n.disabled,...n.group?void 0:{mode:n.mode},...n.disabled?{}:t},r.default)}}})}function X(e,o){let i=arguments.length>2&&arguments[2]!==void 0?arguments[2]:"in-out";return S()({name:e,props:{mode:{type:String,default:i},disabled:Boolean},setup(n,a){let{slots:r}=a;return()=>T(A,{name:n.disabled?"":e,css:!n.disabled,...n.disabled?{}:o},r.default)}})}function Y(){let e=arguments.length>0&&arguments[0]!==void 0?arguments[0]:"";const i=(arguments.length>1&&arguments[1]!==void 0?arguments[1]:!1)?"width":"height",n=N(`offset-${i}`);return{onBeforeEnter(t){t._parent=t.parentNode,t._initialStyle={transition:t.style.transition,overflow:t.style.overflow,[i]:t.style[i]}},onEnter(t){const s=t._initialStyle;t.style.setProperty("transition","none","important"),t.style.overflow="hidden";const u=`${t[n]}px`;t.style[i]="0",t.offsetHeight,t.style.transition=s.transition,e&&t._parent&&t._parent.classList.add(e),requestAnimationFrame(()=>{t.style[i]=u})},onAfterEnter:r,onEnterCancelled:r,onLeave(t){t._initialStyle={transition:"",overflow:t.style.overflow,[i]:t.style[i]},t.style.overflow="hidden",t.style[i]=`${t[n]}px`,t.offsetHeight,requestAnimationFrame(()=>t.style[i]="0")},onAfterLeave:a,onLeaveCancelled:a};function a(t){e&&t._parent&&t._parent.classList.remove(e),r(t)}function r(t){const s=t._initialStyle[i];t.style.overflow=t._initialStyle.overflow,s!=null&&(t.style[i]=s),delete t._initialStyle}}m("fab-transition","center center","out-in");m("dialog-bottom-transition");m("dialog-top-transition");m("fade-transition");m("scale-transition");m("scroll-x-transition");m("scroll-x-reverse-transition");m("scroll-y-transition");m("scroll-y-reverse-transition");m("slide-x-transition");m("slide-x-reverse-transition");const Ge=m("slide-y-transition");m("slide-y-reverse-transition");const Xe=X("expand-transition",Y()),Ye=X("expand-x-transition",Y("",!0)),V=Symbol("Forwarded refs");function C(e,o){let i=e;for(;i;){const n=Reflect.getOwnPropertyDescriptor(i,o);if(n)return n;i=Object.getPrototypeOf(i)}}function Je(e){for(var o=arguments.length,i=new Array(o>1?o-1:0),n=1;n<o;n++)i[n-1]=arguments[n];return e[V]=i,new Proxy(e,{get(a,r){if(Reflect.has(a,r))return Reflect.get(a,r);if(!(typeof r=="symbol"||r.startsWith("$")||r.startsWith("__"))){for(const t of i)if(t.value&&Reflect.has(t.value,r)){const s=Reflect.get(t.value,r);return typeof s=="function"?s.bind(t.value):s}}},has(a,r){if(Reflect.has(a,r))return!0;if(typeof r=="symbol"||r.startsWith("$")||r.startsWith("__"))return!1;for(const t of i)if(t.value&&Reflect.has(t.value,r))return!0;return!1},set(a,r,t){if(Reflect.has(a,r))return Reflect.set(a,r,t);if(typeof r=="symbol"||r.startsWith("$")||r.startsWith("__"))return!1;for(const s of i)if(s.value&&Reflect.has(s.value,r))return Reflect.set(s.value,r,t);return!1},getOwnPropertyDescriptor(a,r){var s;const t=Reflect.getOwnPropertyDescriptor(a,r);if(t)return t;if(!(typeof r=="symbol"||r.startsWith("$")||r.startsWith("__"))){for(const u of i){if(!u.value)continue;const f=C(u.value,r)??("_"in u.value?C((s=u.value._)==null?void 0:s.setupState,r):void 0);if(f)return f}for(const u of i){const f=u.value&&u.value[V];if(!f)continue;const l=f.slice();for(;l.length;){const v=l.shift(),h=C(v.value,r);if(h)return h;const b=v.value&&v.value[V];b&&l.push(...b)}}}}})}export{p as B,Ce as I,P as M,qe as V,Ae as a,Ye as b,Me as c,De as d,He as e,Je as f,Ue as g,Fe as h,Le as i,Xe as j,Ge as k,Be as m,je as n,Ne as s};
