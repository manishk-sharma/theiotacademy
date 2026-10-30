<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  :root {
    --bg: #0b0d12;
    --surf: #13151c;
    --surf2: #1a1d27;
    --bdr: #272a38;
    --acc: #38d9a9;
    --ylw: #ffd43b;
    --red: #ff6b6b;
    --blu: #74c0fc;
    --prp: #b197fc;
    --txt: #dce4f0;
    --dim: #5c6480;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  html, body { width: 100%; height: 100%; overflow: hidden; }
  body {
    background: var(--bg);
    color: var(--txt);
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: 13px;
    display: flex;
    flex-direction: column;
    height: 490px;
  }

  /* TOP BAR */
  .topbar {
    display: flex;
    align-items: center;
    background: var(--surf);
    border-bottom: 1px solid var(--bdr);
    padding: 0 8px;
    flex-shrink: 0;
    gap: 2px;
  }
  .bar-label {
    font-size: 9px;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--acc);
    font-weight: 700;
    margin-right: 8px;
    white-space: nowrap;
  }
  .tab {
    font-size: 10px;
    padding: 7px 10px;
    border: none;
    background: none;
    color: var(--dim);
    cursor: pointer;
    border-bottom: 2px solid transparent;
    transition: color .15s, border-color .15s;
    white-space: nowrap;
    letter-spacing: .04em;
  }
  .tab:hover { color: var(--txt); }
  .tab.on { color: var(--ylw); border-bottom-color: var(--ylw); }

  /* PANELS */
  .panels { flex: 1; overflow: hidden; position: relative; }
  .panel { display: none; width: 100%; height: 100%; padding: 10px 12px; gap: 10px; }
  .panel.on { display: flex; }

  /* LAYOUT */
  .col-main { flex: 1; display: flex; flex-direction: column; gap: 6px; min-width: 0; }
  .col-side { width: 174px; flex-shrink: 0; display: flex; flex-direction: column; gap: 6px; }

  canvas {
    width: 100%; display: block;
    border: 1px solid var(--bdr);
    border-radius: 4px;
    background: var(--surf);
    cursor: crosshair;
  }

  /* CARD */
  .card {
    background: var(--surf);
    border: 1px solid var(--bdr);
    border-radius: 5px;
    padding: 8px 10px;
    flex-shrink: 0;
  }
  .card-title {
    font-size: 9px;
    letter-spacing: .13em;
    text-transform: uppercase;
    color: var(--ylw);
    margin-bottom: 6px;
    font-weight: 700;
  }
  .kv { display: flex; justify-content: space-between; padding: 3px 0; border-bottom: 1px solid var(--bdr); }
  .kv:last-child { border: none; }
  .kk { font-size: 10px; color: var(--dim); font-family: monospace; }
  .vv { font-size: 10px; color: var(--acc); font-family: monospace; font-weight: 700; }
  .vv.r { color: var(--red); }
  .vv.b { color: var(--blu); }
  .vv.p { color: var(--prp); }
  .vv.y { color: var(--ylw); }

  .hint { font-size: 10px; color: var(--dim); font-style: italic; line-height: 1.5; margin-bottom: 4px; }

  /* BUTTONS */
  .btn-row { display: flex; gap: 5px; flex-wrap: wrap; margin-top: 4px; }
  .btn {
    font-size: 9px; letter-spacing: .08em; text-transform: uppercase;
    padding: 4px 8px; border: 1px solid var(--bdr); border-radius: 3px;
    background: var(--surf2); color: var(--txt); cursor: pointer; transition: all .12s;
  }
  .btn:hover { background: var(--acc); border-color: var(--acc); color: #000; }
  .btn.d:hover { background: var(--red); border-color: var(--red); color: #fff; }
  .btn.b:hover { background: var(--blu); border-color: var(--blu); color: #000; }
  .btn.p:hover { background: var(--prp); border-color: var(--prp); color: #000; }

  /* SLIDERS */
  .sl-wrap { margin-bottom: 6px; }
  .sl-head { display: flex; justify-content: space-between; font-size: 10px; color: var(--dim); margin-bottom: 2px; }
  .sl-val { color: var(--acc); }
  input[type=range] { width: 100%; accent-color: var(--ylw); height: 3px; cursor: pointer; }

  /* PROGRESS */
  .bar-track { height: 5px; background: var(--surf2); border-radius: 3px; overflow: hidden; margin-top: 2px; }
  .bar-fill { height: 100%; border-radius: 3px; transition: width .3s; }
  .bar-fill.g { background: linear-gradient(90deg, var(--acc), var(--ylw)); }
  .bar-fill.r { background: linear-gradient(90deg, var(--red), var(--ylw)); }
  .bar-fill.b { background: linear-gradient(90deg, var(--blu), var(--prp)); }

  /* AB BUTTONS */
  .ab-tabs { display: flex; gap: 5px; margin-bottom: 8px; }
  .ab-btn {
    flex: 1; font-size: 10px; padding: 5px; border: 1px solid var(--bdr);
    border-radius: 3px; background: var(--surf2); color: var(--dim);
    cursor: pointer; transition: all .12s; text-align: center;
  }
  .ab-btn:hover { border-color: var(--acc); color: var(--txt); }
  .ab-btn.on { border-color: var(--ylw); color: var(--ylw); background: #1a1800; }

  /* VERDICT BOX */
  .verdict {
    border-radius: 5px; padding: 7px 10px; text-align: center; margin-top: 6px;
    border: 1px solid var(--bdr);
  }
  .verdict-label { font-size: 9px; color: var(--dim); letter-spacing: .1em; text-transform: uppercase; }
  .verdict-val { font-size: 1.6rem; font-weight: 700; line-height: 1.1; }
  .verdict-sub { font-family: monospace; font-size: 10px; color: var(--dim); margin-top: 3px; }

  /* DIST PILLS */
  .dist-pills { display: flex; gap: 4px; flex-wrap: wrap; margin-bottom: 8px; }
  .pill {
    font-size: 9px; padding: 3px 7px; border: 1px solid var(--bdr); border-radius: 10px;
    background: var(--surf2); color: var(--dim); cursor: pointer; transition: all .12s;
  }
  .pill:hover { border-color: var(--acc); color: var(--txt); }
  .pill.on { border-color: var(--acc); color: var(--acc); background: #0c1e18; }

  /* LEGEND */
  .leg-row { display: flex; align-items: center; gap: 5px; font-size: 10px; color: var(--dim); margin-bottom: 3px; }
  .leg-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
  .leg-sq { width: 10px; height: 8px; border-radius: 2px; flex-shrink: 0; }

  /* LOG */
  .log {
    font-family: monospace; font-size: 9px; color: var(--dim);
    max-height: 62px; overflow-y: auto; background: var(--bg);
    border: 1px solid var(--bdr); border-radius: 3px;
    padding: 4px 6px; line-height: 1.6; margin-top: 4px;
  }
  .log span { color: var(--acc); }
  .log .w { color: var(--ylw); }
  .log .r { color: var(--red); }

  /* INLINE TWO-COL */
  .two-col { display: flex; gap: 6px; }
  .two-col > canvas { flex: 1; min-width: 0; }

  .sc-btns { display: flex; gap: 4px; flex-wrap: wrap; margin-bottom: 6px; }
  .sc-btn {
    font-size: 9px; padding: 3px 7px; border: 1px solid var(--bdr); border-radius: 3px;
    background: var(--surf2); color: var(--dim); cursor: pointer; transition: all .12s;
  }
  .sc-btn:hover { border-color: var(--ylw); color: var(--txt); }
  .sc-btn.on { border-color: var(--ylw); color: var(--ylw); background: #1a1800; }
</style>
</head>
<body>

<div class="topbar">
  <span class="bar-label">📊 Business Statistics</span>
  <button class="tab on" onclick="go(0,this)">① Descriptive</button>
  <button class="tab" onclick="go(1,this)">② A/B Testing</button>
  <button class="tab" onclick="go(2,this)">③ Forecasting</button>
  <button class="tab" onclick="go(3,this)">④ Risk & Distribution</button>
</div>

<div class="panels">

  <!-- ══ TAB 0: DESCRIPTIVE STATS ══ -->
  <div class="panel on" id="p0">
    <div class="col-main">
      <canvas id="c0" height="300"></canvas>
      <canvas id="c0b" height="100"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Dataset</div>
        <p class="hint">Click canvas to add sales data points.</p>
        <div class="sc-btns" id="dsRow"></div>
        <div class="btn-row">
          <button class="btn" onclick="loadDS()">Load Example</button>
          <button class="btn d" onclick="clearDS()">Clear</button>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Descriptive Stats</div>
        <div class="kv"><span class="kk">N</span><span class="vv" id="dn">—</span></div>
        <div class="kv"><span class="kk">Mean</span><span class="vv" id="dmean">—</span></div>
        <div class="kv"><span class="kk">Median</span><span class="vv" id="dmed">—</span></div>
        <div class="kv"><span class="kk">Mode</span><span class="vv" id="dmode">—</span></div>
        <div class="kv"><span class="kk">Std Dev</span><span class="vv b" id="dstd">—</span></div>
        <div class="kv"><span class="kk">Range</span><span class="vv y" id="drange">—</span></div>
        <div class="kv"><span class="kk">Q1</span><span class="vv p" id="dq1">—</span></div>
        <div class="kv"><span class="kk">Q3</span><span class="vv p" id="dq3">—</span></div>
        <div class="kv"><span class="kk">IQR</span><span class="vv" id="diqr">—</span></div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 1: A/B TESTING ══ -->
  <div class="panel" id="p1">
    <div class="col-main">
      <canvas id="c1" height="260"></canvas>
      <canvas id="c1h" height="120"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Campaign Setup</div>
        <div class="sl-wrap">
          <div class="sl-head"><span>A: Conv. Rate %</span><span class="sl-val" id="abav">5</span></div>
          <input type="range" id="abaSl" min="1" max="30" step="0.5" value="5" oninput="abav.textContent=parseFloat(this.value).toFixed(1);runAB()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>B: Conv. Rate %</span><span class="sl-val" id="abbv">8</span></div>
          <input type="range" id="abbSl" min="1" max="30" step="0.5" value="8" oninput="abbv.textContent=parseFloat(this.value).toFixed(1);runAB()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Sample Size</span><span class="sl-val" id="abNv">500</span></div>
          <input type="range" id="abNSl" min="50" max="5000" step="50" value="500" oninput="abNv.textContent=this.value;runAB()">
        </div>
        <div class="btn-row">
          <button class="btn" onclick="runAB()">↻ Resample</button>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Test Results</div>
        <div class="kv"><span class="kk">A Conv.</span><span class="vv" id="abac">—</span></div>
        <div class="kv"><span class="kk">B Conv.</span><span class="vv b" id="abbc">—</span></div>
        <div class="kv"><span class="kk">Lift</span><span class="vv y" id="ablift">—</span></div>
        <div class="kv"><span class="kk">Z-score</span><span class="vv p" id="abz">—</span></div>
        <div class="kv"><span class="kk">p-value</span><span class="vv" id="abp">—</span></div>
        <div class="verdict" id="abVerdict">
          <div class="verdict-label">Verdict</div>
          <div class="verdict-val" id="abVval" style="color:var(--dim);font-size:1rem">Run test</div>
          <div class="verdict-sub" id="abVsub"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 2: SALES FORECASTING ══ -->
  <div class="panel" id="p2">
    <div class="col-main">
      <canvas id="c2" height="290"></canvas>
      <canvas id="c2r" height="110"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Forecast Controls</div>
        <div class="sc-btns" id="fcRow"></div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Trend Strength</span><span class="sl-val" id="trendv">5</span></div>
          <input type="range" id="trendSl" min="0" max="10" step="0.5" value="5" oninput="trendv.textContent=parseFloat(this.value).toFixed(1);drawForecast()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Seasonality</span><span class="sl-val" id="seasonv">3</span></div>
          <input type="range" id="seasonSl" min="0" max="10" step="0.5" value="3" oninput="seasonv.textContent=parseFloat(this.value).toFixed(1);drawForecast()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Forecast Periods</span><span class="sl-val" id="fperiodv">6</span></div>
          <input type="range" id="fperiodSl" min="2" max="12" step="1" value="6" oninput="fperiodv.textContent=this.value;drawForecast()">
        </div>
        <div class="btn-row">
          <button class="btn" onclick="genFcData()">↻ New Data</button>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Forecast Stats</div>
        <div class="kv"><span class="kk">MAPE</span><span class="vv r" id="fmape">—</span></div>
        <div class="kv"><span class="kk">MAE</span><span class="vv" id="fmae">—</span></div>
        <div class="kv"><span class="kk">R²</span><span class="vv b" id="fr2">—</span></div>
        <div class="kv"><span class="kk">Next Period</span><span class="vv y" id="fnext">—</span></div>
        <div class="kv"><span class="kk">Peak Forecast</span><span class="vv p" id="fpeak">—</span></div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 3: RISK & DISTRIBUTION ══ -->
  <div class="panel" id="p3">
    <div class="col-main">
      <canvas id="c3" height="240"></canvas>
      <canvas id="c3q" height="130"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Distribution</div>
        <div class="dist-pills" id="distRow"></div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Mean (μ)</span><span class="sl-val" id="dmuv">50</span></div>
          <input type="range" id="dmuSl" min="10" max="90" step="1" value="50" oninput="dmuv.textContent=this.value;drawDist()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Std Dev (σ)</span><span class="sl-val" id="dsigv">15</span></div>
          <input type="range" id="dsigSl" min="3" max="30" step="1" value="15" oninput="dsigv.textContent=this.value;drawDist()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Risk Threshold</span><span class="sl-val" id="thrv">30</span></div>
          <input type="range" id="thrSl" min="0" max="100" step="1" value="30" oninput="thrv.textContent=this.value;drawDist()">
        </div>
        <div class="btn-row">
          <button class="btn" onclick="sampleDist()">↻ Sample</button>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Risk Metrics</div>
        <div class="kv"><span class="kk">P(X < threshold)</span><span class="vv r" id="rprob">—</span></div>
        <div class="kv"><span class="kk">VaR 95%</span><span class="vv y" id="rvar">—</span></div>
        <div class="kv"><span class="kk">CVaR 95%</span><span class="vv r" id="rcvar">—</span></div>
        <div class="kv"><span class="kk">Z-score of thr.</span><span class="vv p" id="rzscore">—</span></div>
        <div class="kv"><span class="kk">Skewness</span><span class="vv b" id="rskew">—</span></div>
        <div class="kv"><span class="kk">Kurtosis</span><span class="vv" id="rkurt">—</span></div>
      </div>
    </div>
  </div>

</div>

<script>
/* ═══════════ UTILS ═══════════ */
const $ = id => document.getElementById(id);
const PAD = 30;

function initCanvas(c, h) {
  const dpr = devicePixelRatio||1;
  const w = c.getBoundingClientRect().width||300;
  c.width = w*dpr; c.height = h*dpr;
  const ctx = c.getContext('2d'); ctx.scale(dpr,dpr);
  return {ctx, w, h};
}

function grid(ctx,w,h){
  ctx.strokeStyle='#1e2130'; ctx.lineWidth=1;
  for(let i=0;i<=8;i++){const x=i/8*w; ctx.beginPath();ctx.moveTo(x,0);ctx.lineTo(x,h);ctx.stroke();}
  for(let i=0;i<=6;i++){const y=i/6*h; ctx.beginPath();ctx.moveTo(0,y);ctx.lineTo(w,y);ctx.stroke();}
  ctx.strokeStyle='#3a3e56'; ctx.lineWidth=1.2;
  ctx.beginPath(); ctx.moveTo(PAD,4); ctx.lineTo(PAD,h-PAD); ctx.lineTo(w-4,h-PAD); ctx.stroke();
}

function tx(v,mn,mx,W,p=PAD){ return p+(v-mn)/(mx-mn)*(W-2*p); }
function ty(v,mn,mx,H,p=PAD){ return (H-p)-(v-mn)/(mx-mn)*(H-2*p); }
function fx(px,mn,mx,W,p=PAD){ return mn+(px-p)/(W-2*p)*(mx-mn); }
function fy(py,mn,mx,H,p=PAD){ return mn+((H-p)-py)/(H-2*p)*(mx-mn); }

function mean(arr){ return arr.reduce((a,b)=>a+b,0)/arr.length; }
function std(arr){ const m=mean(arr); return Math.sqrt(arr.reduce((s,v)=>s+(v-m)**2,0)/arr.length); }
function sorted(arr){ return [...arr].sort((a,b)=>a-b); }
function median(arr){ const s=sorted(arr),n=s.length; return n%2?s[Math.floor(n/2)]:(s[n/2-1]+s[n/2])/2; }
function percentile(arr,p){ const s=sorted(arr),i=(p/100)*(s.length-1),lo=Math.floor(i),hi=Math.ceil(i); return s[lo]+(s[hi]-s[lo])*(i-lo); }
function randNorm(mu=0,sig=1){ let u,v; do{u=Math.random()*2-1;v=Math.random()*2-1;}while(u*u+v*v>=1); return mu+sig*Math.sqrt(-2*Math.log(u*u+v*v))*u/Math.sqrt(u*u+v*v); }
function clamp(v,a,b){ return Math.max(a,Math.min(b,v)); }

function normalPDF(x,mu,sig){ return Math.exp(-0.5*((x-mu)/sig)**2)/(sig*Math.sqrt(2*Math.PI)); }
function normalCDF(x,mu,sig){ const z=(x-mu)/(sig*Math.sqrt(2)); return 0.5*(1+erf(z)); }
function erf(x){ const t=1/(1+0.3275911*Math.abs(x)); const poly=t*(0.254829592+t*(-0.284496736+t*(1.421413741+t*(-1.453152027+t*1.061405429)))); return Math.sign(x)*(1-poly*Math.exp(-x*x)); }

/* ═══════════ TAB 0: DESCRIPTIVE ═══════════ */
let dsData = [];
const DATASETS = [
  {name:'📦 Sales', gen:()=>Array.from({length:20},()=>Math.round(randNorm(65,18)))},
  {name:'💰 Revenue', gen:()=>Array.from({length:18},()=>Math.round(randNorm(120,35)))},
  {name:'👥 Customers', gen:()=>Array.from({length:22},()=>Math.round(randNorm(40,12)))}
];
let curDS=0;

(function buildDSBtns(){
  const row=$('dsRow');
  DATASETS.forEach((d,i)=>{
    const b=document.createElement('button');
    b.className='sc-btn'+(i===0?' on':'');
    b.textContent=d.name;
    b.onclick=()=>{ curDS=i; document.querySelectorAll('#dsRow .sc-btn').forEach((x,j)=>x.classList.toggle('on',j===i)); loadDS(); };
    row.appendChild(b);
  });
})();

function loadDS(){ dsData=DATASETS[curDS].gen(); calcDS(); drawDS(); drawBox(); }
function clearDS(){ dsData=[]; calcDS(); drawDS(); drawBox(); }

$('c0').addEventListener('click', e=>{
  const c=$('c0'), rect=c.getBoundingClientRect();
  const x=e.clientX-rect.left, y=e.clientY-rect.top;
  const w=rect.width, h=300;
  if(x<PAD||x>w-PAD||y<PAD||y>h-PAD) return;
  const val=Math.round(fy(y,0,150,h));
  dsData.push(clamp(val,1,150));
  calcDS(); drawDS(); drawBox();
});

function calcDS(){
  const n=dsData.length;
  $('dn').textContent=n;
  if(n<2){ ['dmean','dmed','dmode','dstd','drange','dq1','dq3','diqr'].forEach(id=>$(id).textContent='—'); return; }
  const s=sorted(dsData);
  const m=mean(dsData), md=median(dsData), sd=std(dsData);
  const q1=percentile(dsData,25), q3=percentile(dsData,75);
  // mode
  const freq={}; let maxF=0,modeV=s[0];
  dsData.forEach(v=>{ freq[v]=(freq[v]||0)+1; if(freq[v]>maxF){maxF=freq[v];modeV=v;} });
  $('dmean').textContent=m.toFixed(2);
  $('dmed').textContent=md.toFixed(2);
  $('dmode').textContent=modeV;
  $('dstd').textContent=sd.toFixed(2);
  $('drange').textContent=(s[n-1]-s[0]).toFixed(0);
  $('dq1').textContent=q1.toFixed(2);
  $('dq3').textContent=q3.toFixed(2);
  $('diqr').textContent=(q3-q1).toFixed(2);
}

function drawDS(){
  const c=$('c0'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,300);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const ymx=150, ymn=0, n=dsData.length;

  ctx.font='9px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='right';
  for(let v=0;v<=150;v+=30) ctx.fillText(v, PAD-4, ty(v,ymn,ymx,h)+3);

  if(n<1){ ctx.font='11px monospace'; ctx.fillStyle='#3a3e56'; ctx.textAlign='center'; ctx.fillText('Click above to add data points, or use Load Example', w/2, h/2); return; }

  // bars
  const bw=Math.min(28, (w-2*PAD)/Math.max(n,1)-2);
  for(let i=0;i<n;i++){
    const bx=tx(i,0,Math.max(n-1,1),w);
    const bh=ty(dsData[i],ymn,ymx,h);
    const basY=ty(0,ymn,ymx,h);
    const grad=ctx.createLinearGradient(0,bh,0,basY);
    grad.addColorStop(0,'#38d9a9'); grad.addColorStop(1,'rgba(56,217,169,0.2)');
    ctx.fillStyle=grad;
    ctx.fillRect(bx-bw/2, bh, bw, basY-bh);
    ctx.strokeStyle='rgba(56,217,169,0.5)'; ctx.lineWidth=0.8;
    ctx.strokeRect(bx-bw/2, bh, bw, basY-bh);
  }

  // mean line
  if(n>=2){
    const m=mean(dsData), sd=std(dsData);
    const my=ty(m,ymn,ymx,h);
    ctx.strokeStyle='#ffd43b'; ctx.lineWidth=2; ctx.setLineDash([6,4]);
    ctx.beginPath(); ctx.moveTo(PAD,my); ctx.lineTo(w-PAD,my); ctx.stroke(); ctx.setLineDash([]);
    ctx.font='9px monospace'; ctx.fillStyle='#ffd43b'; ctx.textAlign='left';
    ctx.fillText(`μ=${m.toFixed(1)}`, PAD+4, my-4);

    // ±1σ band
    const y1=ty(m+sd,ymn,ymx,h), y2=ty(m-sd,ymn,ymx,h);
    ctx.fillStyle='rgba(56,217,169,0.06)';
    ctx.fillRect(PAD,y1,w-PAD-PAD,y2-y1);
    ctx.strokeStyle='rgba(56,217,169,0.25)'; ctx.lineWidth=1; ctx.setLineDash([3,3]);
    ctx.beginPath(); ctx.moveTo(PAD,y1); ctx.lineTo(w-PAD,y1); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(PAD,y2); ctx.lineTo(w-PAD,y2); ctx.stroke();
    ctx.setLineDash([]);
    ctx.font='9px monospace'; ctx.fillStyle='rgba(56,217,169,0.5)'; ctx.textAlign='right';
    ctx.fillText(`+σ`, w-PAD-2, y1-3);
    ctx.fillText(`-σ`, w-PAD-2, y2+10);
  }

  ctx.font='9px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Data Points →', w/2, h-6);
}

function drawBox(){
  const c=$('c0b'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,100);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h);
  ctx.strokeStyle='#1e2130'; ctx.lineWidth=1;
  ctx.beginPath(); ctx.moveTo(PAD,h/2); ctx.lineTo(w-PAD,h/2); ctx.stroke();

  const n=dsData.length;
  if(n<4){ ctx.font='9px monospace'; ctx.fillStyle='#3a3e56'; ctx.textAlign='center'; ctx.fillText('Box plot: need ≥4 points', w/2, h/2+4); return; }

  const s=sorted(dsData), mn=s[0], mx=s[n-1];
  const q1=percentile(dsData,25), q3=percentile(dsData,75), md=median(dsData);
  const m=mean(dsData);
  const rng=mx-mn||1;
  const bx=(v)=>PAD+(v-mn)/rng*(w-2*PAD);
  const cy=h/2, bh=22;

  // whiskers
  ctx.strokeStyle='#38d9a9'; ctx.lineWidth=1.5;
  ctx.beginPath(); ctx.moveTo(bx(mn),cy); ctx.lineTo(bx(q1),cy); ctx.stroke();
  ctx.beginPath(); ctx.moveTo(bx(q3),cy); ctx.lineTo(bx(mx),cy); ctx.stroke();
  ctx.beginPath(); ctx.moveTo(bx(mn),cy-8); ctx.lineTo(bx(mn),cy+8); ctx.stroke();
  ctx.beginPath(); ctx.moveTo(bx(mx),cy-8); ctx.lineTo(bx(mx),cy+8); ctx.stroke();

  // IQR box
  const grad=ctx.createLinearGradient(bx(q1),0,bx(q3),0);
  grad.addColorStop(0,'rgba(56,217,169,0.3)'); grad.addColorStop(1,'rgba(177,151,252,0.3)');
  ctx.fillStyle=grad;
  ctx.strokeStyle='#38d9a9'; ctx.lineWidth=1.5;
  ctx.fillRect(bx(q1),cy-bh/2,bx(q3)-bx(q1),bh);
  ctx.strokeRect(bx(q1),cy-bh/2,bx(q3)-bx(q1),bh);

  // median
  ctx.strokeStyle='#ffd43b'; ctx.lineWidth=2;
  ctx.beginPath(); ctx.moveTo(bx(md),cy-bh/2); ctx.lineTo(bx(md),cy+bh/2); ctx.stroke();
  // mean diamond
  ctx.fillStyle='#ff6b6b';
  ctx.beginPath(); ctx.moveTo(bx(m),cy-6); ctx.lineTo(bx(m)+5,cy); ctx.lineTo(bx(m),cy+6); ctx.lineTo(bx(m)-5,cy); ctx.closePath(); ctx.fill();

  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Box Plot (Q1–Q3 | median=yellow | mean=red◆)', w/2, h-4);
}

/* ═══════════ TAB 1: A/B TESTING ═══════════ */
let abDataA=[], abDataB=[];

function bernoulli(p){ return Math.random()<p?1:0; }

function runAB(){
  const pa=parseFloat($('abaSl').value)/100;
  const pb=parseFloat($('abbSl').value)/100;
  const N=parseInt($('abNSl').value);
  abDataA=Array.from({length:N},()=>bernoulli(pa));
  abDataB=Array.from({length:N},()=>bernoulli(pb));
  const ca=abDataA.filter(x=>x).length, cb=abDataB.filter(x=>x).length;
  const ra=ca/N, rb=cb/N;
  const lift=((rb-ra)/ra*100);
  const pp=(ca+cb)/(2*N);
  const se=Math.sqrt(pp*(1-pp)*(2/N));
  const z=se>0?(rb-ra)/se:0;
  const pval=2*(1-normalCDF(Math.abs(z),0,1));

  $('abac').textContent=(ra*100).toFixed(2)+'%';
  $('abbc').textContent=(rb*100).toFixed(2)+'%';
  $('ablift').textContent=(lift>=0?'+':'')+lift.toFixed(1)+'%';
  $('abz').textContent=z.toFixed(3);
  $('abp').textContent=pval.toFixed(4);

  const sig=pval<0.05;
  const vv=$('abVval'), vs=$('abVsub');
  if(sig){
    if(rb>ra){ vv.textContent='B Wins'; vv.style.color='var(--acc)'; vs.textContent='Statistically significant (p<0.05)'; }
    else { vv.textContent='A Wins'; vv.style.color='var(--ylw)'; vs.textContent='Statistically significant (p<0.05)'; }
  } else {
    vv.textContent='No Sig. Diff'; vv.style.color='var(--dim)'; vs.textContent='p≥0.05 — need more data';
  }
  $('abVerdict').style.background=sig?(rb>ra?'linear-gradient(135deg,#0d1e18,#061510)':'linear-gradient(135deg,#1a1800,#100f00)'):'#13151c';
  $('abVerdict').style.borderColor=sig?(rb>ra?'var(--acc)':'var(--ylw)'):'var(--bdr)';

  drawAB(ra,rb,N,z);
  drawABhist(abDataA,abDataB,N);
}

function drawAB(ra,rb,N,z){
  const c=$('c1'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,260);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);

  // Draw sampling distributions of proportions
  const sig=Math.sqrt(0.1*0.9/N);
  const xmn=Math.min(ra,rb)-4*sig, xmx=Math.max(ra,rb)+4*sig;
  const pts=200;

  // A distribution
  let maxY=0;
  for(let i=0;i<=pts;i++){ const x=xmn+(xmx-xmn)*i/pts; maxY=Math.max(maxY,normalPDF(x,ra,sig),normalPDF(x,rb,sig)); }
  maxY*=1.15;

  // fill A
  ctx.beginPath();
  for(let i=0;i<=pts;i++){
    const x=xmn+(xmx-xmn)*i/pts;
    const y=normalPDF(x,ra,sig);
    const px=tx(x,xmn,xmx,w), py=ty(y,0,maxY,h);
    i===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
  }
  ctx.lineTo(tx(xmx,xmn,xmx,w),ty(0,0,maxY,h));
  ctx.lineTo(tx(xmn,xmn,xmx,w),ty(0,0,maxY,h));
  ctx.closePath();
  ctx.fillStyle='rgba(56,217,169,0.18)'; ctx.fill();
  ctx.strokeStyle='#38d9a9'; ctx.lineWidth=2;
  ctx.beginPath();
  for(let i=0;i<=pts;i++){
    const x=xmn+(xmx-xmn)*i/pts;
    const y=normalPDF(x,ra,sig);
    const px=tx(x,xmn,xmx,w), py=ty(y,0,maxY,h);
    i===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
  }
  ctx.stroke();

  // fill B
  ctx.beginPath();
  for(let i=0;i<=pts;i++){
    const x=xmn+(xmx-xmn)*i/pts;
    const y=normalPDF(x,rb,sig);
    const px=tx(x,xmn,xmx,w), py=ty(y,0,maxY,h);
    i===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
  }
  ctx.lineTo(tx(xmx,xmn,xmx,w),ty(0,0,maxY,h));
  ctx.lineTo(tx(xmn,xmn,xmx,w),ty(0,0,maxY,h));
  ctx.closePath();
  ctx.fillStyle='rgba(116,192,252,0.18)'; ctx.fill();
  ctx.strokeStyle='#74c0fc'; ctx.lineWidth=2;
  ctx.beginPath();
  for(let i=0;i<=pts;i++){
    const x=xmn+(xmx-xmn)*i/pts;
    const y=normalPDF(x,rb,sig);
    const px=tx(x,xmn,xmx,w), py=ty(y,0,maxY,h);
    i===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
  }
  ctx.stroke();

  // Labels
  ctx.font='10px monospace'; ctx.textAlign='center';
  ctx.fillStyle='#38d9a9'; ctx.fillText(`A: ${(ra*100).toFixed(1)}%`, tx(ra,xmn,xmx,w), ty(normalPDF(ra,ra,sig),0,maxY,h)-10);
  ctx.fillStyle='#74c0fc'; ctx.fillText(`B: ${(rb*100).toFixed(1)}%`, tx(rb,xmn,xmx,w), ty(normalPDF(rb,rb,sig),0,maxY,h)-10);

  ctx.font='9px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Sampling distributions of conversion rates', w/2, h-6);
}

function drawABhist(a,b,N){
  const c=$('c1h'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,120);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h);

  const bins=20, bw=(w-2*PAD)/bins;
  const histA=new Array(bins).fill(0), histB=new Array(bins).fill(0);
  // rolling averages of conversions
  const wSize=50;
  const rollA=[], rollB=[];
  for(let i=wSize;i<=N;i+=Math.floor(N/bins)){
    rollA.push(a.slice(i-wSize,i).filter(x=>x).length/wSize*100);
    rollB.push(b.slice(i-wSize,i).filter(x=>x).length/wSize*100);
  }
  const all=[...rollA,...rollB], maxV=Math.max(...all)||1;
  const bh=h-PAD-10;

  rollA.forEach((v,i)=>{
    const x=PAD+i*(w-2*PAD)/Math.max(rollA.length,1);
    const barH=v/maxV*bh;
    ctx.fillStyle='rgba(56,217,169,0.6)';
    ctx.fillRect(x,h-PAD-barH,bw*0.4,barH);
  });
  rollB.forEach((v,i)=>{
    const x=PAD+i*(w-2*PAD)/Math.max(rollB.length,1)+bw*0.45;
    const barH=v/maxV*bh;
    ctx.fillStyle='rgba(116,192,252,0.6)';
    ctx.fillRect(x,h-PAD-barH,bw*0.4,barH);
  });

  ctx.strokeStyle='#3a3e56'; ctx.lineWidth=1;
  ctx.beginPath(); ctx.moveTo(PAD,h-PAD); ctx.lineTo(w-PAD,h-PAD); ctx.stroke();

  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Rolling conversion rate (window=50) — Green=A, Blue=B', w/2, h-4);
}

/* ═══════════ TAB 2: FORECASTING ═══════════ */
let fcRaw=[], fcFit=[], fcForecast=[];
const INDUSTRIES=[
  {name:'🏪 Retail', base:100, trend:4, season:15},
  {name:'💻 SaaS', base:50, trend:8, season:3},
  {name:'🏨 Tourism', base:80, trend:2, season:25},
];
let curFC=0;

(function buildFCBtns(){
  const row=$('fcRow');
  INDUSTRIES.forEach((d,i)=>{
    const b=document.createElement('button');
    b.className='sc-btn'+(i===0?' on':'');
    b.textContent=d.name;
    b.onclick=()=>{ curFC=i; document.querySelectorAll('#fcRow .sc-btn').forEach((x,j)=>x.classList.toggle('on',j===i));
      $('trendSl').value=d.trend; $('trendv').textContent=d.trend;
      $('seasonSl').value=d.season; $('seasonv').textContent=d.season;
      genFcData(); };
    row.appendChild(b);
  });
})();

function genFcData(){
  const ind=INDUSTRIES[curFC];
  fcRaw=[];
  for(let i=0;i<24;i++){
    const trend=ind.base+i*ind.trend*0.5;
    const season=ind.season*Math.sin(2*Math.PI*i/12);
    const noise=randNorm(0,ind.base*0.08);
    fcRaw.push(Math.max(5,Math.round(trend+season+noise)));
  }
  drawForecast();
}

function linRegArr(xs,ys){ const n=xs.length,mx=mean(xs),my=mean(ys); let num=0,den=0; for(let i=0;i<n;i++){num+=(xs[i]-mx)*(ys[i]-my);den+=(xs[i]-mx)**2;} const b1=den?num/den:0,b0=my-b1*mx; return {b0,b1}; }

function drawForecast(){
  const t=parseFloat($('trendSl').value);
  const s=parseFloat($('seasonSl').value);
  const fp=parseInt($('fperiodSl').value);
  const n=fcRaw.length; if(n<6) return;

  // simple linear trend fit
  const xs=Array.from({length:n},(_,i)=>i);
  const reg=linRegArr(xs,fcRaw);
  fcFit=xs.map(i=>reg.b0+reg.b1*i);

  // seasonality (12-month)
  const seasonal=Array(12).fill(0);
  for(let i=0;i<n;i++) seasonal[i%12]+=fcRaw[i]-fcFit[i];
  const avgSeas=seasonal.map(v=>v/(Math.floor(n/12)||1));

  // forecast with user trend/season
  fcForecast=[];
  for(let i=0;i<fp;i++){
    const idx=n+i;
    const trend=(reg.b0+reg.b1*idx)+(t-5)*2;
    const seas=avgSeas[idx%12]*(s/5);
    fcForecast.push(Math.max(1,Math.round(trend+seas)));
  }

  // metrics
  let mae=0, mape=0, ss_res=0, ss_tot=0;
  const my=mean(fcRaw);
  for(let i=0;i<n;i++){
    const e=fcRaw[i]-fcFit[i];
    mae+=Math.abs(e); mape+=Math.abs(e/fcRaw[i]); ss_res+=e*e; ss_tot+=(fcRaw[i]-my)**2;
  }
  mae/=n; mape/=n;
  const r2v=ss_tot?(1-ss_res/ss_tot):1;
  $('fmape').textContent=(mape*100).toFixed(2)+'%';
  $('fmae').textContent=mae.toFixed(2);
  $('fr2').textContent=r2v.toFixed(4);
  $('fnext').textContent=fcForecast[0]||'—';
  $('fpeak').textContent=Math.max(...fcForecast)||'—';

  drawFcMain(fp);
  drawFcResid();
}

function drawFcMain(fp){
  const c=$('c2'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,290);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);

  const n=fcRaw.length;
  const allY=[...fcRaw,...fcFit,...fcForecast];
  const ymn=0, ymx=Math.max(...allY)*1.15;
  const xmx=n+fp-1;

  // x ticks
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  for(let i=0;i<=xmx;i+=4) ctx.fillText(i, tx(i,0,xmx,w), h-6);
  ctx.textAlign='right';
  const ystep=Math.ceil(ymx/5/10)*10||10;
  for(let v=0;v<=ymx;v+=ystep) ctx.fillText(v, PAD-4, ty(v,ymn,ymx,h)+3);

  // forecast confidence band
  const fcSig=std(fcRaw)*0.3;
  ctx.beginPath();
  for(let i=0;i<fcForecast.length;i++){
    const x=tx(n+i,0,xmx,w), y=ty(fcForecast[i]+1.96*fcSig*(i+1)*0.1,ymn,ymx,h);
    i===0?ctx.moveTo(x,y):ctx.lineTo(x,y);
  }
  for(let i=fcForecast.length-1;i>=0;i--){
    const x=tx(n+i,0,xmx,w), y=ty(fcForecast[i]-1.96*fcSig*(i+1)*0.1,ymn,ymx,h);
    ctx.lineTo(x,y);
  }
  ctx.closePath();
  ctx.fillStyle='rgba(255,212,59,0.1)'; ctx.fill();

  // fit line (historic)
  ctx.strokeStyle='rgba(56,217,169,0.5)'; ctx.lineWidth=1.5; ctx.setLineDash([5,3]);
  ctx.beginPath();
  for(let i=0;i<n;i++){
    const px=tx(i,0,xmx,w), py=ty(fcFit[i],ymn,ymx,h);
    i===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
  }
  ctx.stroke(); ctx.setLineDash([]);

  // actual bars
  const bw=Math.max(4,(w-2*PAD)/(xmx+1)-1.5);
  for(let i=0;i<n;i++){
    const bx=tx(i,0,xmx,w);
    const bh_px=ty(fcRaw[i],ymn,ymx,h);
    const basY=ty(0,ymn,ymx,h);
    const grad=ctx.createLinearGradient(0,bh_px,0,basY);
    grad.addColorStop(0,'rgba(116,192,252,0.7)'); grad.addColorStop(1,'rgba(116,192,252,0.1)');
    ctx.fillStyle=grad;
    ctx.fillRect(bx-bw/2,bh_px,bw,basY-bh_px);
  }

  // forecast bars
  for(let i=0;i<fcForecast.length;i++){
    const bx=tx(n+i,0,xmx,w);
    const bh_px=ty(fcForecast[i],ymn,ymx,h);
    const basY=ty(0,ymn,ymx,h);
    const grad=ctx.createLinearGradient(0,bh_px,0,basY);
    grad.addColorStop(0,'rgba(255,212,59,0.8)'); grad.addColorStop(1,'rgba(255,212,59,0.1)');
    ctx.fillStyle=grad;
    ctx.fillRect(bx-bw/2,bh_px,bw,basY-bh_px);
    ctx.strokeStyle='rgba(255,212,59,0.6)'; ctx.lineWidth=0.8;
    ctx.strokeRect(bx-bw/2,bh_px,bw,basY-bh_px);
  }

  // divider
  const divX=tx(n-0.5,0,xmx,w);
  ctx.strokeStyle='rgba(255,107,107,0.5)'; ctx.lineWidth=1.5; ctx.setLineDash([4,3]);
  ctx.beginPath(); ctx.moveTo(divX,PAD); ctx.lineTo(divX,h-PAD); ctx.stroke(); ctx.setLineDash([]);
  ctx.font='8px monospace'; ctx.fillStyle='#ff6b6b'; ctx.textAlign='center';
  ctx.fillText('◀ Actual | Forecast ▶', divX, PAD+8);

  ctx.fillStyle='#555f80'; ctx.fillText('Period →', w/2, h-6);
}

function drawFcResid(){
  const c=$('c2r'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,110);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h);
  const n=Math.min(fcRaw.length,fcFit.length);
  const res=Array.from({length:n},(_,i)=>fcRaw[i]-fcFit[i]);
  const maxR=Math.max(...res.map(Math.abs))*1.3||1;
  const xmx=n-1;

  ctx.strokeStyle='rgba(255,212,59,0.3)'; ctx.lineWidth=1; ctx.setLineDash([4,4]);
  const zy=ty(0,-maxR,maxR,h);
  ctx.beginPath(); ctx.moveTo(PAD,zy); ctx.lineTo(w-PAD,zy); ctx.stroke(); ctx.setLineDash([]);

  for(let i=0;i<res.length;i++){
    const px=tx(i,0,xmx,w), py=ty(res[i],-maxR,maxR,h);
    ctx.beginPath(); ctx.arc(px,py,3,0,Math.PI*2);
    ctx.fillStyle=res[i]>=0?'rgba(255,107,107,0.8)':'rgba(56,217,169,0.8)'; ctx.fill();
    ctx.strokeStyle='rgba(255,255,255,0.15)'; ctx.lineWidth=0.5; ctx.stroke();
  }
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Residuals (Actual − Fitted)', w/2, h-4);
}

/* ═══════════ TAB 3: RISK & DISTRIBUTION ═══════════ */
const DISTS=['Normal','Uniform','Exponential','Bimodal'];
let curDist=0, distSamples=[];

(function buildDistPills(){
  const row=$('distRow');
  DISTS.forEach((d,i)=>{
    const b=document.createElement('button');
    b.className='pill'+(i===0?' on':'');
    b.textContent=d;
    b.onclick=()=>{ curDist=i; document.querySelectorAll('#distRow .pill').forEach((x,j)=>x.classList.toggle('on',j===i)); sampleDist(); };
    row.appendChild(b);
  });
})();

function sampleDist(){
  const mu=parseFloat($('dmuSl').value);
  const sig=parseFloat($('dsigSl').value);
  const N=2000;
  switch(curDist){
    case 0: distSamples=Array.from({length:N},()=>randNorm(mu,sig)); break;
    case 1: distSamples=Array.from({length:N},()=>mu-sig*1.7+Math.random()*sig*3.4); break;
    case 2: distSamples=Array.from({length:N},()=>mu-sig+(-sig*Math.log(Math.random()))); break;
    case 3: distSamples=Array.from({length:N},()=>Math.random()<0.5?randNorm(mu-sig,sig/2):randNorm(mu+sig,sig/2)); break;
  }
  drawDist();
}

function drawDist(){
  const mu=parseFloat($('dmuSl').value);
  const sig=parseFloat($('dsigSl').value);
  const thr=parseFloat($('thrSl').value);
  const c=$('c3'); if(!c.getBoundingClientRect().width) return;
  if(!distSamples.length) sampleDist();

  const {ctx,w,h}=initCanvas(c,240);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);

  const bins=50;
  const s=sorted(distSamples);
  const mn=s[0], mx=s[s.length-1];
  const bw=(mx-mn)/bins;
  const hist=new Array(bins).fill(0);
  distSamples.forEach(v=>{ const bi=Math.min(bins-1,Math.floor((v-mn)/bw)); hist[bi]++; });
  const maxH=Math.max(...hist);
  const xrng=mx-mn||1;

  for(let i=0;i<bins;i++){
    const bx=tx(mn+i*bw,mn,mx,w);
    const bw2=(w-2*PAD)/bins;
    const bh_px=ty(hist[i],0,maxH,h);
    const basY=ty(0,0,maxH,h);
    const midX=mn+(i+0.5)*bw;
    const isRisk=midX<thr;
    const grad=ctx.createLinearGradient(0,bh_px,0,basY);
    if(isRisk){
      grad.addColorStop(0,'rgba(255,107,107,0.85)'); grad.addColorStop(1,'rgba(255,107,107,0.2)');
    } else {
      grad.addColorStop(0,'rgba(56,217,169,0.75)'); grad.addColorStop(1,'rgba(56,217,169,0.15)');
    }
    ctx.fillStyle=grad;
    ctx.fillRect(bx,bh_px,bw2*0.92,basY-bh_px);
  }

  // threshold line
  const thrX=tx(thr,mn,mx,w);
  ctx.strokeStyle='#ff6b6b'; ctx.lineWidth=2; ctx.setLineDash([5,3]);
  ctx.beginPath(); ctx.moveTo(thrX,PAD); ctx.lineTo(thrX,h-PAD); ctx.stroke(); ctx.setLineDash([]);
  ctx.font='9px monospace'; ctx.fillStyle='#ff6b6b'; ctx.textAlign='left';
  ctx.fillText(`⚠ ${thr}`, thrX+3, PAD+12);

  // mean line
  const m=mean(distSamples);
  const mx2=tx(m,mn,mx,w);
  ctx.strokeStyle='#ffd43b'; ctx.lineWidth=1.5; ctx.setLineDash([4,4]);
  ctx.beginPath(); ctx.moveTo(mx2,PAD); ctx.lineTo(mx2,h-PAD); ctx.stroke(); ctx.setLineDash([]);
  ctx.fillStyle='#ffd43b'; ctx.textAlign='right';
  ctx.fillText(`μ=${m.toFixed(1)}`, mx2-3, PAD+12);

  // x ticks
  ctx.textAlign='center'; ctx.fillStyle='#555f80';
  const step=Math.ceil(xrng/6/5)*5||1;
  for(let v=Math.ceil(mn/step)*step;v<=mx;v+=step) ctx.fillText(Math.round(v), tx(v,mn,mx,w), h-6);

  ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText(`${DISTS[curDist]} Distribution`, w/2, h-6);

  // metrics
  const prob=distSamples.filter(v=>v<thr).length/distSamples.length;
  const var95=percentile(distSamples,5);
  const cvar=mean(distSamples.filter(v=>v<=var95));
  const skw=calcSkew(distSamples);
  const krt=calcKurt(distSamples);

  $('rprob').textContent=(prob*100).toFixed(2)+'%';
  $('rvar').textContent=var95.toFixed(2);
  $('rcvar').textContent=isNaN(cvar)?'—':cvar.toFixed(2);
  $('rzscore').textContent=sig>0?((thr-m)/sig).toFixed(3):'—';
  $('rskew').textContent=skw.toFixed(3);
  $('rkurt').textContent=krt.toFixed(3);

  drawQQ(distSamples);
}

function calcSkew(arr){ const n=arr.length,m=mean(arr),s=std(arr)||1; return arr.reduce((sum,v)=>sum+(v-m)**3,0)/(n*s**3); }
function calcKurt(arr){ const n=arr.length,m=mean(arr),s=std(arr)||1; return arr.reduce((sum,v)=>sum+(v-m)**4,0)/(n*s**4)-3; }

function drawQQ(data){
  const c=$('c3q'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,130);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);

  const n=200; // subsample
  const step=Math.floor(data.length/n);
  const sub=sorted(data.filter((_,i)=>i%step===0)).slice(0,n);
  const m2=sub.length;
  if(m2<4){ return; }

  // theoretical quantiles from standard normal
  const theor=Array.from({length:m2},(_,i)=>{
    const p=(i+0.5)/m2;
    return normInv(p);
  });

  const thMin=theor[0],thMax=theor[m2-1];
  const sMin=sub[0],sMax=sub[m2-1];

  // reference line
  const m=mean(sub),s=std(sub)||1;
  ctx.strokeStyle='rgba(255,212,59,0.4)'; ctx.lineWidth=1.5; ctx.setLineDash([4,4]);
  ctx.beginPath();
  ctx.moveTo(tx(thMin,thMin,thMax,w), ty(m+s*thMin,sMin,sMax,h));
  ctx.lineTo(tx(thMax,thMin,thMax,w), ty(m+s*thMax,sMin,sMax,h));
  ctx.stroke(); ctx.setLineDash([]);

  // points
  for(let i=0;i<m2;i++){
    ctx.beginPath(); ctx.arc(tx(theor[i],thMin,thMax,w),ty(sub[i],sMin,sMax,h),1.5,0,Math.PI*2);
    ctx.fillStyle='rgba(177,151,252,0.75)'; ctx.fill();
  }
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Q-Q Plot (theoretical vs. sample quantiles)', w/2, h-4);
}

function normInv(p){
  // Rational approximation for normal inverse CDF
  if(p<=0) return -5; if(p>=1) return 5;
  const c=[2.515517,0.802853,0.010328];
  const d=[1.432788,0.189269,0.001308];
  function t(pp){ return Math.sqrt(-2*Math.log(pp)); }
  if(p<0.5){
    const tt=t(p);
    return -(tt-(c[0]+c[1]*tt+c[2]*tt*tt)/(1+d[0]*tt+d[1]*tt*tt+d[2]*tt*tt*tt));
  }
  const tt=t(1-p);
  return (tt-(c[0]+c[1]*tt+c[2]*tt*tt)/(1+d[0]*tt+d[1]*tt*tt+d[2]*tt*tt*tt));
}

/* ═══════════ TAB SWITCHING ═══════════ */
function go(i,btn){
  document.querySelectorAll('.panel').forEach((p,j)=>p.classList.toggle('on',j===i));
  document.querySelectorAll('.tab').forEach((b,j)=>b.classList.toggle('on',j===i));
  if(i===0) setTimeout(()=>{drawDS();drawBox();},30);
  if(i===1) setTimeout(()=>runAB(),30);
  if(i===2) setTimeout(()=>drawForecast(),30);
  if(i===3) setTimeout(()=>drawDist(),30);
}

/* ═══════════ INIT ═══════════ */
window.addEventListener('load',()=>{
  setTimeout(()=>{
    loadDS();
    runAB();
    genFcData();
    sampleDist();
  },200);
});
window.addEventListener('resize',()=>{
  drawDS(); drawBox();
  const panel=document.querySelector('.panel.on');
  if(!panel) return;
  const idx=[...document.querySelectorAll('.panel')].indexOf(panel);
  if(idx===1){drawAB(parseFloat($('abaSl').value)/100,parseFloat($('abbSl').value)/100,parseInt($('abNSl').value),0);drawABhist(abDataA,abDataB,abDataA.length);}
  if(idx===2) drawForecast();
  if(idx===3) drawDist();
});
</script>
</body>
</html>
