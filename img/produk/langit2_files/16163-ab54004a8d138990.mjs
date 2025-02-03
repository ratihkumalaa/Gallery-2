(self.__LOADABLE_LOADED_CHUNKS__=self.__LOADABLE_LOADED_CHUNKS__||[]).push([[16163,89870],{60139:e=>{"use strict";function t(e){return function(){return e}}var i=function(){};i.thatReturns=t,i.thatReturnsFalse=t(!1),i.thatReturnsTrue=t(!0),i.thatReturnsNull=t(null),i.thatReturnsThis=function(){return this},i.thatReturnsArgument=function(e){return e},e.exports=i},663620:(e,t,i)=>{"use strict";var n=i(60139);e.exports=n},87636:(e,t,i)=>{"use strict";i.d(t,{Z:()=>r});var n=i(667294),o=i(993640),a=i(785893);function r({page:e,children:t}){let i=(0,n.useMemo)(()=>({logging:{viewType:"login"===e&&9||"businessLogin"===e&&267||void 0},pageType:e}),[e]);return(0,a.jsx)(n.Fragment,{children:(0,a.jsx)(o.Mi,{value:i,children:t})})}},692461:(e,t,i)=>{"use strict";i.d(t,{Z:()=>O});var n=i(667294),o=i(545007),a=i(191855),r=i(573706),s=i(914896),l=i(378690),c=i(906769),p=i(337584),d=i(395225),g=i(993640),h=i(194093),u=i(144326),m=i(297726),f=i(267005),b=i(894789),_=i(391731),x=i(260134),w=i(982553),y=i(719174),j=i(76367),v=i(765963),Z=i(359017),S=i(297728),T=i(272158),P=i(730212),A=i(1006),I=i(154785),E=i(410150),M=i(383399),C=i(785893);function k(e,t,i){var n;return(t="symbol"==typeof(n=function(e,t){if("object"!=typeof e||!e)return e;var i=e[Symbol.toPrimitive];if(void 0!==i){var n=i.call(e,t||"default");if("object"!=typeof n)return n;throw TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(t,"string"))?n:n+"")in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}class L extends n.Component{constructor(...e){super(...e),k(this,"state",{modal:null}),k(this,"annotateOneTapStopwatch",e=>(0,T.M3)("google_autologin",e)),k(this,"abortOneTapStopwatch",e=>(0,T.RP)("google_autologin",e)),k(this,"stopOneTapStopwatch",()=>(0,T.PA)("google_autologin")),k(this,"trackAutologin",e=>(0,A.dy)({event:e,provider:"google"})),k(this,"deferredHandleOneTapResponse",e=>{setTimeout(()=>{this.handleOneTapResponse(e)},5e3)}),k(this,"handleOneTapResponse",e=>{let{autologinDisabled:t,login:i,viewer:n}=this.props;if(!e)return;let{credential:o,select_by:a}=e,r=(0,_.PL)(a),s="AUTO_LOGIN"===r;if(this.annotateOneTapStopwatch("autoLoginGoogleEnd"),this.stopOneTapStopwatch(),s&&t)return;s&&this.trackAutologin("pinterest_login_start");let{pageContext:l}=this.props;i({creds:{google_open_id_token:o,autologin:s},loggingOptions:{loggingData:{container:"google_one_tap_modal",page:l?.pageType,trigger:(0,_.mK)(r)},loginAttemptContextEvent:{event_type:7534,element:"SIGN_IN_WITH_GOOGLE_BUTTON"===r?12981:"ONE_TAP_PROMPT"===r?12982:null,aux_data:{signup_login_method:v.Z.GOOGLE_ONE_TAP,upsell_reason:s?"autologin_google":"google_one_tap",...n.isAuth?{login_state:n.isLimitedLogin?y.Z.LIMITED:y.Z.DEFAULT}:{}}}}}).then(()=>{let{nextUrl:e}=this.props;s&&this.trackAutologin("pinterest_login_success"),e?j.ZP.handleRedirect(e):j.ZP.handleRedirectWithFallbackWindowLocation(),s&&this.trackAutologin("end")},e=>{let{hide:t,handleLoginWithMfa:i}=this.props;s&&this.trackAutologin("pinterest_login_failure");let n=(0,h.Z)(e,"api_error_code");if(n===f.xN){if("SIGN_IN_WITH_GOOGLE_BUTTON"===r)this.attemptSignup({googleOpenId:o});else{let e="business_login_page"===this.props.container;this.setState({modal:{type:"confirmSignup",step:e?s&&"staticSignupLogin"||"delayedSignupLoadingSpinner":"staticSignupLoginWithTOS",handleConfirmSignup:()=>this.attemptSignup({googleOpenId:o})}})}}else if(n===f.Zn)i(o);else if(n===f.an)this.setState({modal:{type:"accountSuspended"}});else{let e=this.props.i18n._('We couldn\u2019t log you in with that account. Try the Google button!', ' - ', ' -- ');(0,p.x)(e),t()}s&&this.trackAutologin("end")})}),k(this,"attemptSignup",({googleOpenId:e})=>{let{handleGdprRequiresAge:t,pageContext:i}=this.props,n=(0,b.Z)(e);t({options:{type:"google",google_open_id_token:e,first_name:n.given_name,last_name:n.family_name,image_url:n.picture},context:{container:"google_one_tap_modal",page:i?.pageType}}),(0,A.NC)("check_age_with_one_tap_from_one_tap_dweb")})}componentDidMount(){let{requestContext:e,webGoogleDisabled:t}=this.props;s.U2(a.e7)&&(0,A.My)(`pcons.google_autologin_disabled_cookie.login_page.${(0,Z.M)()}`),t||s.U2(a.e7)&&e.isBot?this.abortOneTapStopwatch("disabled"):(this.setupGoogleOneTap(),e.isBot||(0,A.My)("unauth_web_container.google_one_tap_modal.tier1.other.shown"))}async setupGoogleOneTap(){let{googleSignInApi:e,deviceType:t}=this.props;await e?.ensureInit("oneTap",this.deferredHandleOneTapResponse),this.trackAutologin("show_ui"),_.Fm()?.prompt(e=>{w.z(e,t)})}render(){let{requestContext:e,webGoogleDisabled:t,hide:i}=this.props,{modal:n}=this.state;if(e.isBot||t||!n)return null;switch(n.type){case"accountSuspended":return(0,C.jsx)(l.Z,{onClose:()=>this.setState({modal:null})});case"confirmSignup":return(0,C.jsx)(c.Z,{handleCancelClick:()=>this.setState({modal:null}),handleConfirmSignup:n.handleConfirmSignup,handleShowLogin:i,step:n.step});default:return null}}}function O({container:e,handleGdprRequiresAge:t,handleLoginWithMfa:i,nextUrl:a}){let s=(0,d.Z)(),{logContextEvent:l}=(0,r.v)(),c=(0,u.ZP)(),p=(0,o.I0)(),h=(0,M.Z)(),[f,b]=(0,n.useState)(!0),{checkExperiment:_}=(0,S.F)(),{anyEnabled:w}=_("web_google_disabled"),y=(0,P.B)(),j=(0,g.lO)(),{country:v}=y,Z=(0,x.M)(),T=(0,m.q)(),A=(0,I.Z)(),k=(0,E.ZP)();if(!f||T)return null;let O=()=>b(!1);return(0,C.jsx)(L,{autologinDisabled:"CH"===v,checkExperiment:_,container:e,deviceType:k,dispatch:p,googleSignInApi:Z,handleEmptyCredentials:O,handleGdprRequiresAge:e=>{O(),t(e)},handleLoginWithMfa:e=>{O(),i(e)},hide:O,i18n:c,logContextEvent:l,login:s,nextUrl:a,pageContext:j,requestContext:y,trackInteraction:A,viewer:h,webGoogleDisabled:w})}},526561:(e,t,i)=>{"use strict";i.d(t,{Z:()=>I});var n=i(667294),o=i(616550),a=i(883119),r=i(87636),s=i(692461),l=i(449112),c=i(212515),p=i(338513),d=i(669521),g=i(529858),h=i(11905),u=i(476198),m=i(144326),f=i(512541),b=i(887103),_=i(516733),x=i(730212),w=i(635258),y=i(901450),j=i(868808),v=i(566344),Z=i(521079),S=i(62052),T=i(785893);let P=`${v.C0}${w.Hm8}`,A=()=>h.Z+d.Z;function I({redirectToBusinessForSignup:e,isForLimitedLogin:t,attributionLabel:i}){(0,c.Q)({view_type:9});let d=(0,m.ZP)(),h=(0,o.TH)(),w=(0,j.mB)(h.search),v=(0,y.F9)(),[I,E]=(0,n.useState)({type:"login"}),[M,C]=(0,n.useState)(!1),{isMobile:k}=(0,x.B)().userAgent,L=w.next&&(0,Z.Z)(w.next)?w.next:"/",O=t||"true"!==w.board_invite?"login":"boardInvite",D=e=>{e&&v.showOneToast(({hideToast:t})=>(0,T.jsx)(u.Z,{duration:b.Jl,onHide:t,text:e}))};(0,n.useEffect)(()=>{D((0,_.Z)(d,h))},[]);let U="signup"===I.type;return(0,n.useEffect)(()=>{e&&U&&(0,l.Z)(P,!1)},[e,U]),(0,T.jsx)(r.Z,{page:"login",children:(0,T.jsxs)(a.xu,{height:"100%",position:"absolute",top:!0,width:"100%",children:[(0,T.jsx)(a.xu,{bottom:!0,dangerouslySetInlineStyle:{__style:{overflowY:"hidden"}},left:!0,position:"absolute",right:!0,top:!0,children:(0,T.jsx)(S.default,{})}),(0,T.jsx)(a.xu,{bottom:!0,dangerouslySetInlineStyle:{__style:{background:"rgba(0, 0, 0, .5)"}},left:!0,position:"fixed",right:!0,top:!0}),M?(0,T.jsx)(g.Z,{}):(0,T.jsxs)(n.Fragment,{children:[(0,T.jsxs)(a.xu,{dangerouslySetInlineStyle:{__style:{left:"50%",top:"50%",transform:"translate(-50%, -50%)"}},position:"absolute",children:[(0,T.jsx)(f.Z,{unsafeCSS:A()}),(0,T.jsx)(p.default,{attributionLabel:i,container:"login_page",handleShowingSignupWelcomeLoading:e=>{e!==M&&C(e)},nextUrlParam:L,signupFlow:I,signupRedirectUrl:e?P:"",signupSource:O,toggleType:"SMALL_TOGGLE"})]}),!k&&(0,T.jsx)(a.xu,{"data-test-id":"login"===I.type?"simple-signup-button":"simple-login-button",left:!0,marginStart:6,marginTop:12,position:"absolute",top:!0,children:(0,T.jsx)(a.zx,{color:"white",fullWidth:!0,onClick:()=>{E("login"===I.type?{type:"signup"}:{type:"login"})},text:"login"===I.type?d._('Sign up', 'sign up for account toggle on homepage', 'sign up for account toggle on homepage'):d._('Log in', 'Label for log in button', 'Label for log in button')})}),(0,T.jsx)(s.Z,{container:"login_page",handleGdprRequiresAge:({options:e,context:t})=>{E({type:"socialSignupWithAge",registrationCredentials:{type:"google_one_tap",context:t,signupOptions:e}})},handleLoginWithMfa:e=>{E({type:"loginMfa",creds:{google_open_id_token:e}})},nextUrl:L})]})]})})}},454047:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});let n='-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",Helvetica,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro",メイリオ,Meiryo,"ＭＳ Ｐゴシック",Arial,sans-serif'},858705:(e,t,i)=>{"use strict";i.d(t,{Z:()=>o});var n=i(667294);let o=()=>{let[e,t]=(0,n.useState)(!1);return(0,n.useEffect)(()=>{t(!0)},[]),e}},906769:(e,t,i)=>{"use strict";i.d(t,{Z:()=>h});var n=i(667294),o=i(883119),a=i(488792),r=i(144326),s=i(969119),l=i(785893);function c({handleSignup:e,handleLogin:t}){let i=(0,r.ZP)(),[a,c]=(0,n.useState)(!1),p=(0,n.useRef)(null);return(0,s.Z)(()=>{let t;return p.current=window.setTimeout(()=>{t=window.requestAnimationFrame(()=>{c(!0)}),e()},2e3),()=>{p.current&&window.clearTimeout(p.current),t&&window.cancelAnimationFrame(t)}}),(0,l.jsxs)(o.kC,{alignItems:"center",direction:"column",flex:"grow",justifyContent:"center",children:[(0,l.jsx)(o.xu,{children:(0,l.jsx)(o.xv,{align:"center",size:"400",weight:"bold",children:a?i._('Finishing up...', 'Title of a dialog telling the user that an account is almost done being created.', 'Title of a dialog telling the user that an account is almost done being created.'):i._('Creating your account...', 'Title of a dialog telling the user that an account is being created.', 'Title of a dialog telling the user that an account is being created.')})}),(0,l.jsx)(o.xu,{paddingY:4,children:(0,l.jsx)(o.$j,{accessibilityLabel:i._('Account is being created', 'Accessibility label for account creation loading dialog', 'Accessibility label for account creation loading dialog'),show:!0})}),a?null:(0,l.jsx)(o.xu,{marginTop:2,children:(0,l.jsx)(o.xv,{align:"center",inline:!0,children:i._('Didn\u2019t mean to create a new account?', 'Description text telling the user that they can log in if they did not intend to create a new account', 'Description text telling the user that they can log in if they did not intend to create a new account')})}),a?null:(0,l.jsx)(o.xu,{children:(0,l.jsx)(o.xv,{align:"center",inline:!0,children:(0,l.jsx)(o.rU,{display:"inlineBlock",href:"/login",onClick:({event:e,dangerouslyDisableOnNavigation:i})=>{i(),p.current&&window.clearTimeout(p.current),e&&(e.preventDefault(),e.stopPropagation()),t()},underline:"hover",children:i._('Click here to log in.', 'Login button which will show the login modal and enable the user to log in', 'Login button which will show the login modal and enable the user to log in')})})})]})}var p=i(555086),d=i(644182);let g=({children:e})=>(0,l.jsx)(o.xu,{bottom:!0,dangerouslySetInlineStyle:{__style:{backgroundColor:"rgba(0, 0, 0, 0.6)"}},left:!0,opacity:1,position:"fixed",right:!0,top:!0,zIndex:new o.Ry(1e3),children:(0,l.jsx)(o.xu,{color:"default",direction:"column",display:"flex",margin:6,padding:7,position:"fixed",right:!0,rounding:2,top:!0,width:376,children:e})});function h({handleCancelClick:e,handleConfirmSignup:t,handleShowLogin:i,step:h}){let u=(0,r.ZP)(),[m,f]=(0,n.useState)(!1),b=(0,a.Z)(),_={view_type:10,view_parameter:3202};(0,s.Z)(()=>(b({event_type:120,view_parameter:_.view_parameter}),document.body&&(document.body.style.overflow="hidden"),()=>{document.body&&(document.body.style.overflow="")}));let x=()=>{b({..._,event_type:101,element:30}),i()};return(0,l.jsx)(g,{children:"delayedSignupLoadingSpinner"===h?(0,l.jsx)(c,{handleLogin:x,handleSignup:()=>{b({..._,event_type:101,element:31}),t()}}):(0,l.jsxs)(o.xu,{children:[m?(0,l.jsx)(d.Z,{}):null,(0,l.jsx)(o.xu,{display:"inlineBlock",marginEnd:2,marginTop:2,position:"absolute",right:!0,top:!0,children:(0,l.jsx)(o.hU,{accessibilityLabel:u._('Cancel', 'Button to close the signup/login modal', 'Button to close the signup/login modal'),icon:"cancel",iconColor:"gray",onClick:()=>{b({..._,event_type:101,element:73}),e()},size:"sm"})}),(0,l.jsx)(o.xv,{align:"start",size:"400",weight:"bold",children:u._('Continue to Pinterest', 'Title of a dialog telling enabling the user to continue with sign up or log in', 'Title of a dialog telling enabling the user to continue with sign up or log in')}),(0,l.jsx)(o.xu,{marginTop:2,children:(0,l.jsx)(o.xv,{align:"start",children:u._('Hmm, it looks like you don\'t have an account yet. Let\'s get started!', 'Description text of a dialog asking the user to sign up for a Pinterest account', 'Description text of a dialog asking the user to sign up for a Pinterest account')})}),(0,l.jsx)(o.xu,{marginTop:5,children:(0,l.jsx)(o.zx,{color:"red",fullWidth:!0,onClick:()=>{b({..._,event_type:101,element:31}),f(!0),t()},text:u._('Sign up', 'Text on a button which will create an account when clicked', 'Text on a button which will create an account when clicked')})}),(0,l.jsx)(o.xu,{marginTop:2,children:(0,l.jsx)(o.zx,{color:"gray",fullWidth:!0,onClick:x,text:u._('Log in using a different method', 'Text on a button which will take the user to login when clicked.', 'Text on a button which will take the user to login when clicked.')})}),"staticSignupLoginWithTOS"===h?(0,l.jsx)(o.xu,{marginEnd:4,marginStart:4,marginTop:4,children:(0,l.jsx)(p.Z,{})}):null]})})}},669521:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});let n=`
.Tooltip_message:before, .Tooltip_message:after {
  border-style: solid;
  content: '';
  display: block;
  margin-top: -8px;
  position: absolute;
  right: 100%;
  top: 17px;
  width: 0;
}
.Tooltip_message:before {
  border-color: transparent rgba(0,0,0,0.48);
  border-width: 8px 10px 8px 0;
}
.Tooltip_message:after {
  border-color: transparent #fff;
  border-width: 8px 10px 8px 0;
  margin-right: -1px;
}
.Tooltip_mobileMessage:before, .Tooltip_message:after {
  border-style: solid;
  display: block;
  margin-top: -8px;
  position: absolute;
  right: 100%;
  top: 17px;
  width: 0;
}
.Tooltip_mobileMessage:before {
  border-color: transparent rgba(0,0,0,0.48);
  border-width: 8px 10px 8px 0;
}
.Tooltip_mobileMessage:after {
  border-color: transparent #fff;
  border-width: 8px 10px 8px 0;
  margin-right: -1px;
}
.Tooltip_wrapper {
  position: absolute;
  left: calc(100% + 12px);
  z-index: 1;
}
.Tooltip_mobileWrapper {
  margin-top: 7px;
  z-index: 1;
}

.TermsOfService__light a {
  color: rgba(255,255,255,0.9);
}
`},11905:(e,t,i)=>{"use strict";i.d(t,{Z:()=>o});var n=i(454047);let o=`
article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
nav,
section,
ul {
  display: block;
}

audio,
canvas,
video {
  display: inline-block;
}

audio:not([controls]) {
  display: none;
}

html {
  font-size: 100%;
  text-size-adjust: none;
}

a:hover,
a:active {
  outline: 0;
}

sub,
sup {
  position: relative;
  font-size: 75%;
  line-height: 0;
  vertical-align: baseline;
}
sup {
  top: -0.5em;
}
sub {
  bottom: -0.25em;
}

img {
  max-width: 100%;
  width: auto;
  height: auto;

  vertical-align: middle;
  border: 0;
  -ms-interpolation-mode: bicubic;
}

#map_canvas img {
  max-width: none;
}

fieldset {
  border: 0;
  margin: 0;
  padding: 0;
}

button,
input,
select,
textarea {
  font-size: 100%;
  margin: 0;
  vertical-align: middle;
}
button,
input {
  overflow: visible;
  line-height: normal;
}
button::-moz-focus-inner,
input::-moz-focus-inner {
  padding: 0;
  border: 0;
}
button,
input[type='button'],
input[type='reset'],
input[type='submit'] {
  cursor: pointer;
  -webkit-appearance: button;
}
textarea {
  overflow: auto;
  vertical-align: top;
}
body {
  margin: 0;
}
h1, h2, h3, h4, h5, h6 {
  margin: 0;
}
figure {
  margin: 0;
}
html {
  background-color: #fff;
}

html, body {
  font-family: ${n.Z};
  color: rgb(33, 25, 34);
  font-size: 12px;
  height: 100%;
}

body {
  position: relative;
  overflow-y: overlay;
  overflow-x: hidden;
}

input::-ms-clear {
  display: none;
}

ul {
  margin: 0;
  padding: 0;
}

ul li {
  list-style: none;
  padding: 0;
}

button, input, select, textarea {
  font-family: ${n.Z};
  font-size: 100%;
  vertical-align: middle;
  margin: 0px;
}

.SkipToContent {
  display: none;
}
`},537416:(e,t,i)=>{"use strict";i.d(t,{Z:()=>s});var n=i(883119),o=i(858705),a=i(790394),r=i(785893);function s({isFlexible:e,images:t}){return(0,o.Z)()&&(0,r.jsx)(n.xu,{bottom:!0,dangerouslySetInlineStyle:{__style:{pointerEvents:"none"}},left:!0,maxHeight:2500,overflow:"hidden",paddingX:5,paddingY:6,position:"absolute",right:!0,top:!0,children:(0,r.jsx)(n.Rk,{gutterWidth:16,items:t??a.Z,layout:e?"flexible":"basic",minCols:2,renderItem:({data:{height:e,url:t,width:i}})=>(0,r.jsx)(n.zd,{rounding:4,wash:!0,children:(0,r.jsx)(n.Ee,{alt:"pin-image",naturalHeight:e??1,naturalWidth:i??1,src:t??""})})})})}},790394:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});let n=[{url:"https://i.pinimg.com/236x/b3/41/6e/b3416e2688aa4d20f846aeb8127e6b3b.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/23/ad/5f/23ad5fc40270120b22bea471fe3656aa.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/83/39/1e/83391e3103e17a46e2733b09bf154a06.jpg",width:236,height:156},{url:"https://i.pinimg.com/236x/87/f7/b5/87f7b55bc3de78ef95fd36fa3a237172.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/d3/49/07/d34907c96950574c15719219e0f0dd69.jpg",width:236,height:295},{url:"https://i.pinimg.com/236x/49/ad/71/49ad71817c829e8d86ca16fa6508b0c4.jpg",width:236,height:314},{url:"https://i.pinimg.com/236x/a8/7f/53/a87f53ea636966bf24cf279ed2fdc4dc.jpg",width:236,height:314},{url:"https://i.pinimg.com/236x/36/67/b4/3667b449f3cacaaeef3f68fc9cf609be.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/9d/4f/43/9d4f43222d4fc694a61f7635f2d42892.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/48/d9/f0/48d9f0a63ac5c08b1cf2608ceb4a884f.jpg",width:236,height:419},{url:"https://i.pinimg.com/236x/3e/08/94/3e0894b99543507463864c64c6b3af49.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/4b/a4/97/4ba49798105ddfc0bfd11a980f18590f.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/b9/e9/8f/b9e98fe7ff81c026b488997900eb25fa.jpg",width:236,height:314},{url:"https://i.pinimg.com/236x/96/e0/4a/96e04ac53becd9f522988fc27343ac6e.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/5a/f5/9e/5af59e46be8a92abd880031be67ce4cc.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/71/f2/e6/71f2e6a1a13223864dd833bc128f8e2f.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/db/b2/09/dbb2099909d25dd45d3df4950429312d.jpg",width:236,height:309},{url:"https://i.pinimg.com/236x/d7/f9/b0/d7f9b0f7dc0536e923026e6af91c61d5.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/4b/6e/36/4b6e36884909d421e250050db82d013b.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/0b/85/ca/0b85ca13cbf16fa3017164b9c4b65923.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/28/d9/35/28d935a8f25905a6989709b21241e4d2.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/94/e5/fb/94e5fb084bb73b1237a73fc83eb07b45.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/ec/c7/66/ecc766782029713523ae6a5bd8544045.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/1a/c5/72/1ac572b1643cf518ef06139eca46dd1d.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/d1/8f/f9/d18ff9eaec83c75b878eebb899604b8e.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/b3/41/6e/b3416e2688aa4d20f846aeb8127e6b3b.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/23/ad/5f/23ad5fc40270120b22bea471fe3656aa.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/8f/e5/32/8fe532eea42b7c8b14947a2ced8b127d.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/29/6d/a2/296da26a335fd7079e6355225c051cf3.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/cd/53/e3/cd53e3b9ad897d5c5588094f446cbc2a.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/18/54/21/1854212e113994080084b4666b23fcc5.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/cf/0c/45/cf0c451732bb352b3c96d1951ea632dd.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/d0/e9/ee/d0e9ee92a6398e6b31b1515c2ec6ab5e.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/8d/8c/86/8d8c86e41d810497a7b60c5a0e58a95f.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/57/0c/d6/570cd6ac36a208808edabf74682cca8d.jpg",width:236,height:314},{url:"https://i.pinimg.com/236x/bd/57/32/bd5732c8291d05e8982662a1ee043411.jpg",width:236,height:188},{url:"https://i.pinimg.com/236x/1b/10/5e/1b105ea0da81722178e23c5438fb68d7.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/ee/2d/d3/ee2dd31a93246fb72490c012b16eefca.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/81/8a/ca/818aca5d5303c60bff125a5acc322fc0.jpg",width:236,height:295},{url:"https://i.pinimg.com/236x/c6/bc/64/c6bc64acbaab2cca4f9166539ff36621.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/d7/38/27/d73827a583f46fbeaf282acc001eb733.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/2a/02/05/2a0205019cb0cb1ea0baa9b95eb78ab8.jpg",width:236,height:256},{url:"https://i.pinimg.com/236x/60/81/65/60816514dcfcbcab0df772dc78ca8ed1.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/0d/2f/fb/0d2ffbcdcc414765ef441752b423a6ad.jpg",width:236,height:353},{url:"https://i.pinimg.com/236x/d0/97/0b/d0970b1c57a50afa4d6951d8b0657715.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/7d/c5/99/7dc599bce4115d38ee5b91dcd8769543.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/70/0e/56/700e56a3bccb989ab88819ade445e86e.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/ff/73/ab/ff73ab3256bbcf8abce0febb98939e4f.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/e7/1b/ba/e71bbaca118e1ae09f01bcc45b58229f.jpg",width:236,height:185},{url:"https://i.pinimg.com/236x/37/af/bf/37afbf3c16baf0f70dc083b6c6ffecec.jpg",width:236,height:298},{url:"https://i.pinimg.com/236x/64/9d/1b/649d1b77d8b28995b2902b89001f912c.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/8f/e5/32/8fe532eea42b7c8b14947a2ced8b127d.jpg",width:236,height:354},{url:"https://i.pinimg.com/236x/fc/5f/44/fc5f44cd50535f378b1e09d11433c1a8.jpg",width:236,height:330},{url:"https://i.pinimg.com/236x/21/af/78/21af78021ad083377aa3e36ae6f09fc2.jpg",width:236,height:314},{url:"https://i.pinimg.com/236x/06/41/9c/06419c4e4165596f77d721d88665e4e7.jpg",width:236,height:157},{url:"https://i.pinimg.com/236x/2a/9e/80/2a9e80b4714ac32943ddec01399b5387.jpg",width:236,height:156},{url:"https://i.pinimg.com/236x/fc/5f/44/fc5f44cd50535f378b1e09d11433c1a8.jpg",width:236,height:330}]},986782:(e,t,i)=>{"use strict";i.d(t,{Z:()=>s});var n=i(667294),o=i(79292),a=i(415787);function r(e,t,i){var n;return(t="symbol"==typeof(n=function(e,t){if("object"!=typeof e||!e)return e;var i=e[Symbol.toPrimitive];if(void 0!==i){var n=i.call(e,t||"default");if("object"!=typeof n)return n;throw TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(t,"string"))?n:n+"")in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}class s extends n.Component{constructor(...e){super(...e),r(this,"state",{error:null,info:null}),r(this,"resetError",()=>{this.setState({error:null,info:null})})}componentDidCatch(e,t){try{let{name:t}=this.props,i=this.props.type||"secondary";(0,o.T)({extraData:e.extraData??{},errorBoundary:t,errorBoundaryType:i,message:e.message,name:e.name,stack:e.stack}),(0,a.nP)("react.error_boundary",{sampleRate:.1,tags:{component:void 0,name:this.props.name}})}catch(e){(0,a.nP)("react.error_boundary.error",{sampleRate:1,tags:{name:this.props.name}})}this.setState({error:e,info:t})}render(){let{renderErrorState:e}=this.props,{error:t,info:i}=this.state;return t&&i?e?e({error:t,info:i,resetError:this.resetError}):null:this.props.children}}},602185:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});let n=i(986782).Z},611735:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});let n={BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,F5:116,HOME:36,LEFT:37,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38}},359017:(e,t,i)=>{"use strict";i.d(t,{H:()=>l,M:()=>s});var n=i(191855),o=i(914896),a=i(1006);let r=()=>!!o.U2(n.x3),s=()=>{let e=o.U2(n.yu);return e?Math.floor((new Date().getTime()-new Date(e).getTime())/864e5):-1},l=()=>(o.U2(n.e7)&&(0,a.My)(`pcons.non_google_autologin_disabled_cookie.${s()}`),r()||!!o.U2(n.e7))},750077:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});let n=i(352006).Z},272109:(e,t,i)=>{"use strict";i.d(t,{Z:()=>s});var n=i(611735),o=i(439476),a=i(785893);let r=()=>{};function s({allowClickAndDrag:e,allowEsc:t,allowMediaPlay:i,allowScroll:s,children:l}){let c=e=>{t&&e.keyCode===n.Z.ESCAPE||(0,o.Z)(e)};return(0,a.jsx)("div",{onAbort:o.Z,onAnimationEnd:o.Z,onAnimationIteration:o.Z,onAnimationStart:o.Z,onBlur:r,onCanPlay:i?r:o.Z,onCanPlayThrough:o.Z,onChange:o.Z,onClick:e?r:o.Z,onCompositionEnd:o.Z,onCompositionStart:o.Z,onCompositionUpdate:o.Z,onContextMenu:o.Z,onCopy:o.Z,onCut:o.Z,onDoubleClick:o.Z,onDurationChange:o.Z,onEmptied:o.Z,onEncrypted:o.Z,onEnded:o.Z,onError:o.Z,onFocus:r,onInput:o.Z,onInvalid:o.Z,onKeyDown:c,onKeyPress:c,onKeyUp:c,onLoad:o.Z,onLoadedData:o.Z,onLoadedMetadata:o.Z,onLoadStart:o.Z,onMouseDown:o.Z,onMouseEnter:o.Z,onMouseLeave:o.Z,onMouseMove:e?r:o.Z,onMouseOut:o.Z,onMouseOver:o.Z,onMouseUp:e?r:o.Z,onPaste:o.Z,onPause:o.Z,onPlay:o.Z,onPlaying:o.Z,onProgress:o.Z,onRateChange:o.Z,onScroll:s?r:o.Z,onSeeked:o.Z,onSeeking:o.Z,onSelect:o.Z,onStalled:o.Z,onSubmit:o.Z,onSuspend:o.Z,onTimeUpdate:o.Z,onTouchCancel:o.Z,onTouchEnd:e?r:o.Z,onTouchMove:e?r:o.Z,onTouchStart:e?r:o.Z,onTransitionEnd:o.Z,onVolumeChange:o.Z,onWaiting:o.Z,onWheel:o.Z,children:l})}},439476:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});let n=e=>{e.stopPropagation(),e.nativeEvent&&e.nativeEvent.stopImmediatePropagation&&e.nativeEvent.stopImmediatePropagation()}},401218:(e,t,i)=>{"use strict";i.d(t,{Z:()=>a});let n=[".at",".com.au",".ca",".ch",".cl",".de",".dk",".es",".fr",".co.uk",".ie",".it",".jp",".co.kr",".com.mx",".nz",".ph",".pt",".ru",".se"],o=new RegExp(/^(.+\.)?(pinterest|pinterdev)\.com$/),a=e=>o.test(e)||n.some(t=>e===`pinterest${t}`||e.endsWith(`.pinterest${t}`))},521079:(e,t,i)=>{"use strict";i.d(t,{Z:()=>o});var n=i(401218);let o=e=>{if(e.startsWith("//"))return!1;if(e.startsWith("/"))return!0;if(e.startsWith("http://")||e.startsWith("https://"))try{let t=new URL(e);if(t.username)return!1;return(0,n.Z)(t.host)}catch(e){}return!1}},62052:(e,t,i)=>{"use strict";i.r(t),i.d(t,{default:()=>x});var n=i(667294),o=i(545007),a=i(537416),r=i(790394),s=i(609326),l=i(192820),c=i(640498),p=i(864723),d=i(166408),g=i(1006);let h={logUrlAndFirstPinImageSig(e){if((0,p.M0)().getItem(s.W3)===window.location.pathname)return;let t={path:window.location.pathname,ts:Date.now(),first_pin_image_signature:e||""};(0,p.M0)().prependItem(s._b,t,c.LG);let i=(0,d.Nl)();i.prependItem(l.Wc,t,c.LG),(0,g.My)("unauth.web.session.visited_pins."+(i.getItem(l.Wc)||[]).length),(0,p.M0)().prependItem(s.MS,t,c.LG);try{(0,p.M0)().setItem(s.W3,window.location.pathname)}catch(e){console.error(e)}},logLastVisitedBoardLandingPage(e){if(!e||!e.board)return;let t=(0,p.M0)().getItem(s.om)||[];if(t){for(let i of t)if(i&&i.board_id===e.board.id)return}let i={ts:Date.now(),board_id:e.board.id,first_pin_id:e.id,first_pin_image_signature:e.image_signature};(0,p.M0)().prependItem(s.om,i,c.UO)},logPinCTAClick(e){(0,p.M0)().prependItem(s._b,{path:e,ts:Date.now(),actions:[1]},c.LG)},logUnauthPins(e,t=!0){if(e.length)try{(0,p.M0)().setItem(s.TJ,e),t&&(0,d.Nl)().prependItem(l.Qk,e[0])}catch(e){console.error(e)}},getUnauthPins:()=>(0,p.M0)().getItem(s.TJ)||[],getUnauthSessionsPins:()=>(0,d.Nl)().getItem(l.Qk)||[]};var u=i(35928),m=i(785893);function f(e,t,i){var n;return(t="symbol"==typeof(n=function(e,t){if("object"!=typeof e||!e)return e;var i=e[Symbol.toPrimitive];if(void 0!==i){var n=i.call(e,t||"default");if("object"!=typeof n)return n;throw TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(t,"string"))?n:n+"")in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}let b=({dominant_color:e,height:t,type:i,url:n,width:o})=>({dominant_color:e,height:t,type:i,url:n,width:o});class _ extends n.PureComponent{constructor(...e){super(...e),f(this,"state",{insertedBestPinsImages:[],insertedTopicImages:[],pinImages:[],seoPinImage:void 0}),f(this,"insertExtraImages",e=>this.setState({...e})),f(this,"getSEOPinImageToInsert",()=>{let{inNux:e}=this.props;return e?this.getUnauthPinImages()[0]:void 0}),f(this,"getUnauthPinImages",(e=!1)=>{let t=e?h.getUnauthSessionsPins():h.getUnauthPins(),i=new Set;return t.filter(e=>e.images&&e.images["236x"]).map(e=>e.images["236x"]).filter(e=>{let t=i.has(e.url);return i.add(e.url),!t})}),f(this,"getBackgroundImages",()=>{let{insertedBestPinsImages:e,insertedTopicImages:t,pinImages:i,seoPinImage:n}=this.state,o=t.length+(n?1:0),a=[];return(a=(a=(a=(a=a.concat(n||[])).concat(e)).concat(t)).concat(i.slice(o))).map(e=>b(e))})}componentDidMount(){let{defaultPinImages:e}=this.props,t=this.getSEOPinImageToInsert(),i=[...t?[t]:[],...e||r.Z.map(({url:e,width:t,height:i})=>({url:e,width:t,height:i}))];this.setState({pinImages:i,seoPinImage:t})}componentDidUpdate(e){let{inNux:t,nuxSelectedInterestImages:i,nuxStep:n}=this.props,o=e.nuxSelectedInterestImages,{seoPinImage:a}=this.state;if(o&&i&&o!==i){let e=t&&i.length>o.length&&i[i.length-1].bestPinsImages||[],r=t&&"topic"===n&&0===e.length?i.filter(e=>!a||(0,u.lN)(e.url)!==(0,u.lN)(a.url)):[];this.insertExtraImages({insertedTopicImages:r,insertedBestPinsImages:e})}}render(){let{isFlexible:e}=this.props;return(0,m.jsx)(a.Z,{images:this.getBackgroundImages(),isFlexible:e})}}function x(e){let{nuxSelectedInterestImages:t,nuxProgress:i}=(0,o.v9)(({ui:e})=>e);return(0,m.jsx)(_,{...e,nuxSelectedInterestImages:t&&t.images,nuxStep:i&&i.step})}},35928:(e,t,i)=>{"use strict";i.d(t,{HW:()=>r,lN:()=>s});var n=i(609326),o=i(864723);function a(e){let t=[];if(e){let i=Date.now()-72e5;for(let n of e)n.ts>=i&&("image_signature"in n&&"string"==typeof n.image_signature&&t.push(n.image_signature),"first_pin_image_signature"in n&&"string"==typeof n.first_pin_image_signature&&t.push(n.first_pin_image_signature))}return t}function r(){return{plpImages:a((0,o.M0)().getItem(n.e9)||[]),blpImages:a((0,o.M0)().getItem(n.om)||[])}}function s(e){return((e??"").split("/").pop()??"").replace(/(--.*|\.jpg)$/g,"")}},373897:e=>{e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var i=0,n=Array(t);i<t;i++)n[i]=e[i];return n},e.exports.__esModule=!0,e.exports.default=e.exports},163405:(e,t,i)=>{var n=i(373897);e.exports=function(e){if(Array.isArray(e))return n(e)},e.exports.__esModule=!0,e.exports.default=e.exports},564836:e=>{e.exports=function(e){return e&&e.__esModule?e:{default:e}},e.exports.__esModule=!0,e.exports.default=e.exports},379498:e=>{e.exports=function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)},e.exports.__esModule=!0,e.exports.default=e.exports},742281:e=>{e.exports=function(){throw TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.__esModule=!0,e.exports.default=e.exports},600861:(e,t,i)=>{var n=i(163405),o=i(379498),a=i(386116),r=i(742281);e.exports=function(e){return n(e)||o(e)||a(e)||r()},e.exports.__esModule=!0,e.exports.default=e.exports},386116:(e,t,i)=>{var n=i(373897);e.exports=function(e,t){if(e){if("string"==typeof e)return n(e,t);var i=({}).toString.call(e).slice(8,-1);return"Object"===i&&e.constructor&&(i=e.constructor.name),"Map"===i||"Set"===i?Array.from(e):"Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i)?n(e,t):void 0}},e.exports.__esModule=!0,e.exports.default=e.exports}}]);
//# sourceMappingURL=https://sm.pinimg.com/webapp/16163-ab54004a8d138990.mjs.map