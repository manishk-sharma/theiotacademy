<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loss Function in Machine Learning — Interactive Simulator</title>
<style>
  :root {
    --bg: #0b0d12; --surf: #13151c; --surf2: #1a1d27; --bdr: #272a38;
    --acc: #38d9a9; --ylw: #ffd43b; --red: #ff6b6b; --blu: #74c0fc;
    --prp: #b197fc; --txt: #dce4f0; --dim: #5c6480;
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
    height: 520px;
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
  .col-side { width: 178px; flex-shrink: 0; display: flex; flex-direction: column; gap: 6px; }

  canvas {
    width: 100%; display: block;
    border: 1px solid var(--bdr);
    border-radius: 4px;
    background: var(--surf);
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
  .vv.r { color: var(--red); } .vv.b { color: var(--blu); }
  .vv.p { color: var(--prp); } .vv.y { color: var(--ylw); }

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

  /* SLIDERS */
  .sl-wrap { margin-bottom: 6px; }
  .sl-head { display: flex; justify-content: space-between; font-size: 10px; color: var(--dim); margin-bottom: 2px; }
  .sl-val { color: var(--acc); }
  input[type=range] { width: 100%; accent-color: var(--ylw); height: 3px; cursor: pointer; }

  /* PILLS */
  .pill-row { display: flex; gap: 4px; flex-wrap: wrap; margin-bottom: 6px; }
  .pill {
    font-size: 9px; padding: 3px 7px; border: 1px solid var(--bdr); border-radius: 10px;
    background: var(--surf2); color: var(--dim); cursor: pointer; transition: all .12s;
  }
  .pill:hover { border-color: var(--acc); color: var(--txt); }
  .pill.on { border-color: var(--acc); color: var(--acc); background: #0c1e18; }

  /* TWO-COL */
  .two-col { display: flex; gap: 6px; }
  .two-col > canvas { flex: 1; min-width: 0; }

  /* LOG */
  .log {
    font-family: monospace; font-size: 9px; color: var(--dim);
    max-height: 58px; overflow-y: auto; background: var(--bg);
    border: 1px solid var(--bdr); border-radius: 3px;
    padding: 4px 6px; line-height: 1.6; margin-top: 4px;
  }
  .log span { color: var(--acc); }
  .log .w { color: var(--ylw); }
  .log .r { color: var(--red); }
</style>
</head>
<body>

<div class="topbar">
  <span class="bar-label">🧠 Loss Functions — ML Simulator</span>
  <button class="tab on" onclick="go(0,this)">① Loss Landscape</button>
  <button class="tab" onclick="go(1,this)">② Regression Losses</button>
  <button class="tab" onclick="go(2,this)">③ Classification</button>
  <button class="tab" onclick="go(3,this)">④ Gradient Descent</button>
</div>

<div class="panels">

  <!-- ══ TAB 0: LOSS LANDSCAPE ══ -->
  <div class="panel on" id="p0">
    <div class="col-main">
      <canvas id="c0" height="290"></canvas>
      <canvas id="c0b" height="110"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Loss Function</div>
        <p class="hint">Compare how MSE, MAE & Huber penalise errors.</p>
        <div class="pill-row" id="lossRow"></div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Outlier Error</span><span class="sl-val" id="outlierV">3.0</span></div>
          <input type="range" id="outlierSl" min="0.1" max="6" step="0.1" value="3" oninput="updateLandscape()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Huber δ</span><span class="sl-val" id="huberV">1.0</span></div>
          <input type="range" id="huberSl" min="0.2" max="4" step="0.1" value="1" oninput="updateLandscape()">
        </div>
      </div>
      <div class="card">
        <div class="card-title">At Error = <span id="errLabel">3.0</span></div>
        <div class="kv"><span class="kk">MSE</span><span class="vv r" id="mseVal">—</span></div>
        <div class="kv"><span class="kk">MAE</span><span class="vv b" id="maeVal">—</span></div>
        <div class="kv"><span class="kk">Huber</span><span class="vv p" id="huberVal">—</span></div>
        <div class="kv"><span class="kk">Log-Cosh</span><span class="vv y" id="logcoshVal">—</span></div>
      </div>
      <div class="card">
        <div class="card-title">Key Insight</div>
        <div class="hint" id="lossInsight">MSE squares errors — outliers get heavily penalised. MAE is robust but not smooth at 0.</div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 1: REGRESSION LOSSES ══ -->
  <div class="panel" id="p1">
    <div class="col-main">
      <canvas id="c1" height="270"></canvas>
      <div class="two-col">
        <canvas id="c1mse" height="100"></canvas>
        <canvas id="c1mae" height="100"></canvas>
      </div>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Regression Setup</div>
        <p class="hint">Drag outlier slider. See how each loss responds.</p>
        <div class="sl-wrap">
          <div class="sl-head"><span>Outlier Magnitude</span><span class="sl-val" id="outMagV">2.0</span></div>
          <input type="range" id="outMagSl" min="0" max="5" step="0.1" value="2" oninput="updateRegression()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Noise σ</span><span class="sl-val" id="noiseV">0.3</span></div>
          <input type="range" id="noiseSl" min="0.05" max="1.5" step="0.05" value="0.3" oninput="genRegData();updateRegression()">
        </div>
        <div class="btn-row">
          <button class="btn" onclick="genRegData();updateRegression()">Resample</button>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Loss Values</div>
        <div class="kv"><span class="kk">MSE</span><span class="vv r" id="regMSE">—</span></div>
        <div class="kv"><span class="kk">MAE</span><span class="vv b" id="regMAE">—</span></div>
        <div class="kv"><span class="kk">Huber</span><span class="vv p" id="regHuber">—</span></div>
        <div class="kv"><span class="kk">RMSE</span><span class="vv y" id="regRMSE">—</span></div>
      </div>
      <div class="card">
        <div class="card-title">Legend</div>
        <div class="kv"><span class="kk" style="color:var(--acc)">● Data</span><span class="kk" style="color:var(--red)">● Outlier</span></div>
        <div class="kv"><span class="kk" style="color:var(--red)">— MSE fit</span><span class="kk" style="color:var(--blu)">— MAE fit</span></div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 2: CLASSIFICATION ══ -->
  <div class="panel" id="p2">
    <div class="col-main">
      <canvas id="c2" height="270"></canvas>
      <div class="two-col">
        <canvas id="c2a" height="100"></canvas>
        <canvas id="c2b" height="100"></canvas>
      </div>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Loss Type</div>
        <div class="pill-row" id="clsRow"></div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Predicted Prob p</span><span class="sl-val" id="predPV">0.7</span></div>
          <input type="range" id="predPSl" min="0.01" max="0.99" step="0.01" value="0.7" oninput="updateClassification()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>True Label</span><span class="sl-val" id="trueLV">1</span></div>
          <input type="range" id="trueLSl" min="0" max="1" step="1" value="1" oninput="updateClassification()">
        </div>
      </div>
      <div class="card">
        <div class="card-title">Loss at p=<span id="pLabel">0.70</span>, y=<span id="yLabel">1</span></div>
        <div class="kv"><span class="kk">Cross-Entropy</span><span class="vv r" id="ceVal">—</span></div>
        <div class="kv"><span class="kk">Hinge</span><span class="vv b" id="hingeVal">—</span></div>
        <div class="kv"><span class="kk">Focal (γ=2)</span><span class="vv p" id="focalVal">—</span></div>
        <div class="kv"><span class="kk">Binary Acc</span><span class="vv y" id="accVal">—</span></div>
      </div>
      <div class="card">
        <div class="card-title">Use Case</div>
        <div class="hint" id="clsInsight">Cross-Entropy: ideal for probabilities — penalises confident wrong predictions heavily.</div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 3: GRADIENT DESCENT ══ -->
  <div class="panel" id="p3">
    <div class="col-main">
      <canvas id="c3" height="270"></canvas>
      <canvas id="c3b" height="110"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Optimizer Setup</div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Learning Rate</span><span class="sl-val" id="lrV">0.10</span></div>
          <input type="range" id="lrSl" min="0.01" max="0.5" step="0.01" value="0.1" oninput="resetGD()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Momentum β</span><span class="sl-val" id="momV">0.00</span></div>
          <input type="range" id="momSl" min="0" max="0.95" step="0.05" value="0" oninput="resetGD()">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Start θ</span><span class="sl-val" id="thetaV">-3.0</span></div>
          <input type="range" id="thetaSl" min="-4" max="4" step="0.1" value="-3" oninput="resetGD()">
        </div>
        <div class="btn-row">
          <button class="btn" onclick="stepGD()">Step</button>
          <button class="btn" onclick="runGD()">Run</button>
          <button class="btn d" onclick="resetGD()">Reset</button>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Training Log</div>
        <div class="kv"><span class="kk">Epoch</span><span class="vv y" id="gdEpoch">0</span></div>
        <div class="kv"><span class="kk">θ (weight)</span><span class="vv b" id="gdTheta">—</span></div>
        <div class="kv"><span class="kk">Loss</span><span class="vv r" id="gdLoss">—</span></div>
        <div class="kv"><span class="kk">Gradient</span><span class="vv p" id="gdGrad">—</span></div>
      </div>
      <div class="log" id="gdLog">Adjust sliders and press Step or Run...</div>
    </div>
  </div>

</div>

<script>
const $=id=>document.getElementById(id);
const PAD=28;

function initCanvas(c,h){
  const dpr=devicePixelRatio||1;
  const w=c.offsetWidth;
  if(!w) return {ctx:c.getContext('2d'),w:200,h};
  c.width=w*dpr; c.height=h*dpr;
  const ctx=c.getContext('2d');
  ctx.scale(dpr,dpr);
  return {ctx,w,h};
}
function tx(v,mn,mx,W){return PAD+(v-mn)/(mx-mn)*(W-2*PAD);}
function ty(v,mn,mx,H){return H-PAD-(v-mn)/(mx-mn)*(H-2*PAD);}
function grid(ctx,w,h){
  ctx.strokeStyle='rgba(39,42,56,0.8)'; ctx.lineWidth=1;
  for(let i=0;i<=5;i++){
    const y=PAD+i*(h-2*PAD)/5;
    ctx.beginPath();ctx.moveTo(PAD,y);ctx.lineTo(w-PAD,y);ctx.stroke();
    const x=PAD+i*(w-2*PAD)/5;
    ctx.beginPath();ctx.moveTo(x,PAD);ctx.lineTo(x,h-PAD);ctx.stroke();
  }
}
function axisLabels(ctx,w,h,mn,mx,vmn,vmx){
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  for(let i=0;i<=5;i++){
    const v=mn+i*(mx-mn)/5;
    ctx.fillText(v.toFixed(1),tx(v,mn,mx,w),h-6);
  }
  ctx.textAlign='right';
  for(let i=0;i<=4;i++){
    const v=vmn+i*(vmx-vmn)/4;
    ctx.fillText(v.toFixed(1),PAD-3,ty(v,vmn,vmx,h)+3);
  }
}

/* ═══ LOSS MATH ═══ */
function mse(e){return e*e;}
function mae(e){return Math.abs(e);}
function huber(e,d){const ae=Math.abs(e);return ae<=d?0.5*e*e:d*(ae-0.5*d);}
function logcosh(e){return Math.log(Math.cosh(e));}

/* ═══ TAB 0: LOSS LANDSCAPE ═══ */
const LOSSES=['MSE','MAE','Huber','Log-Cosh'];
const LOSS_COLORS=['#ff6b6b','#74c0fc','#b197fc','#ffd43b'];
const LOSS_INSIGHTS=[
  'MSE squares errors — outliers dominate. Great for Gaussian noise, bad for heavy-tailed data.',
  'MAE is robust to outliers but non-differentiable at 0. Gradient is always ±1 regardless of error size.',
  'Huber combines MSE (small errors) and MAE (large errors). δ controls the transition point.',
  'Log-Cosh ≈ MAE for large errors, ≈ MSE for small ones. Smooth and differentiable everywhere.'
];
let activeLoss=[true,true,true,true];

(function buildLossPills(){
  const row=$('lossRow');
  LOSSES.forEach((l,i)=>{
    const b=document.createElement('button');
    b.className='pill on';
    b.textContent=l;
    b.style.borderColor=LOSS_COLORS[i];
    b.style.color=LOSS_COLORS[i];
    b.style.background='#0c1e18';
    b.onclick=()=>{
      activeLoss[i]=!activeLoss[i];
      b.style.opacity=activeLoss[i]?'1':'0.4';
      b.style.background=activeLoss[i]?'#0c1e18':'var(--surf2)';
      updateLandscape();
      const first=activeLoss.indexOf(true);
      if(first>=0) $('lossInsight').textContent=LOSS_INSIGHTS[first];
    };
    row.appendChild(b);
  });
})();

function updateLandscape(){
  const outlier=parseFloat($('outlierSl').value);
  const delta=parseFloat($('huberSl').value);
  $('outlierV').textContent=outlier.toFixed(1);
  $('huberV').textContent=delta.toFixed(1);
  $('errLabel').textContent=outlier.toFixed(1);
  $('mseVal').textContent=mse(outlier).toFixed(3);
  $('maeVal').textContent=mae(outlier).toFixed(3);
  $('huberVal').textContent=huber(outlier,delta).toFixed(3);
  $('logcoshVal').textContent=logcosh(outlier).toFixed(3);
  drawLandscape(outlier,delta);
  drawGradientPanel(outlier,delta);
}

function drawLandscape(outlier,delta){
  const c=$('c0'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,290);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const errs=Array.from({length:400},(_,i)=>-6+i*12/399);
  const vmx=36;
  axisLabels(ctx,w,h,-6,6,0,vmx);
  ctx.font='8px monospace'; ctx.fillStyle='#555f80';
  ctx.textAlign='center'; ctx.fillText('Error (predicted − actual)',w/2,h-4);
  ctx.textAlign='left'; ctx.fillStyle='#555f80'; ctx.fillText('Loss',4,PAD-4);

  const fns=[e=>mse(e),e=>mae(e),e=>huber(e,delta),e=>logcosh(e)];
  fns.forEach((fn,i)=>{
    if(!activeLoss[i]) return;
    ctx.beginPath(); ctx.strokeStyle=LOSS_COLORS[i]; ctx.lineWidth=2;
    errs.forEach((e,j)=>{
      const y=Math.min(fn(e),vmx);
      const px=tx(e,-6,6,w), py=ty(y,0,vmx,h);
      j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
    });
    ctx.stroke();
  });

  const ox=tx(outlier,-6,6,w);
  ctx.strokeStyle='rgba(255,212,59,0.5)'; ctx.lineWidth=1; ctx.setLineDash([4,4]);
  ctx.beginPath(); ctx.moveTo(ox,PAD); ctx.lineTo(ox,h-PAD); ctx.stroke();
  ctx.setLineDash([]);

  let lx=PAD; const ly=PAD+10;
  LOSSES.forEach((l,i)=>{
    if(!activeLoss[i]) return;
    ctx.fillStyle=LOSS_COLORS[i]; ctx.fillRect(lx,ly,18,3);
    ctx.fillStyle='#dce4f0'; ctx.font='8px monospace'; ctx.textAlign='left';
    ctx.fillText(l,lx+22,ly+4); lx+=52;
  });
}

function drawGradientPanel(outlier,delta){
  const c=$('c0b'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,110);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const errs=Array.from({length:400},(_,i)=>-6+i*12/399);
  const gradFns=[
    e=>2*e,
    e=>e===0?0:(e>0?1:-1),
    e=>{ const ae=Math.abs(e); return ae<=delta?e:delta*Math.sign(e); },
    e=>Math.tanh(e)
  ];
  const vmn=-6, vmx=6;
  axisLabels(ctx,w,h,-6,6,vmn,vmx);
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Gradient (∂L/∂e)',w/2,h-4);
  ctx.strokeStyle='rgba(255,212,59,0.25)'; ctx.lineWidth=1; ctx.setLineDash([3,3]);
  ctx.beginPath(); ctx.moveTo(PAD,ty(0,vmn,vmx,h)); ctx.lineTo(w-PAD,ty(0,vmn,vmx,h)); ctx.stroke();
  ctx.setLineDash([]);
  gradFns.forEach((fn,i)=>{
    if(!activeLoss[i]) return;
    ctx.beginPath(); ctx.strokeStyle=LOSS_COLORS[i]; ctx.lineWidth=1.5;
    errs.forEach((e,j)=>{
      const g=Math.max(vmn,Math.min(vmx,fn(e)));
      const px=tx(e,-6,6,w), py=ty(g,vmn,vmx,h);
      j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
    });
    ctx.stroke();
  });
}

/* ═══ TAB 1: REGRESSION LOSSES ═══ */
let regX=[],regY=[],regOutIdx=0;

function randNorm(mu,sig){
  let u=0,v=0;
  while(!u){u=Math.random();} while(!v){v=Math.random();}
  return mu+sig*Math.sqrt(-2*Math.log(u))*Math.cos(2*Math.PI*v);
}

function genRegData(){
  const sig=parseFloat($('noiseSl').value);
  $('noiseV').textContent=sig.toFixed(2);
  regX=[]; regY=[];
  for(let i=0;i<20;i++){
    regX.push(-3+i*0.32);
    regY.push(0.8*regX[i]+randNorm(0,sig));
  }
  regOutIdx=Math.floor(Math.random()*20);
}

function linFit(x,y){
  const n=x.length;
  const mx=x.reduce((s,v)=>s+v,0)/n;
  const my=y.reduce((s,v)=>s+v,0)/n;
  const num=x.reduce((s,v,i)=>s+(v-mx)*(y[i]-my),0);
  const den=x.reduce((s,v)=>s+(v-mx)**2,0);
  const b=num/den; const a=my-b*mx;
  return {a,b};
}

function updateRegression(){
  const outMag=parseFloat($('outMagSl').value);
  $('outMagV').textContent=outMag.toFixed(1);
  const yMod=[...regY];
  yMod[regOutIdx]+=outMag;

  const {a:aMSE,b:bMSE}=linFit(regX,yMod);

  let aMae=0,bMae=0;
  for(let iter=0;iter<300;iter++){
    let da=0,db=0;
    yMod.forEach((yi,i)=>{
      const e=yi-(aMae+bMae*regX[i]);
      const s=e>0?1:-1;
      da-=s; db-=s*regX[i];
    });
    const lr=0.01;
    aMae-=lr*da/yMod.length;
    bMae-=lr*db/yMod.length;
  }

  const mseLoss=yMod.reduce((s,yi,i)=>s+(yi-(aMSE+bMSE*regX[i]))**2,0)/yMod.length;
  const maeLoss=yMod.reduce((s,yi,i)=>s+Math.abs(yi-(aMae+bMae*regX[i])),0)/yMod.length;
  const huberL=yMod.reduce((s,yi,i)=>s+huber(yi-(aMSE+bMSE*regX[i]),1.0),0)/yMod.length;

  $('regMSE').textContent=mseLoss.toFixed(4);
  $('regMAE').textContent=maeLoss.toFixed(4);
  $('regHuber').textContent=huberL.toFixed(4);
  $('regRMSE').textContent=Math.sqrt(mseLoss).toFixed(4);

  drawRegressionMain(yMod,aMSE,bMSE,aMae,bMae,outMag);
  drawResidPanel($('c1mse'),regX,yMod,aMSE,bMSE,'MSE Residuals','#ff6b6b');
  drawResidPanel($('c1mae'),regX,yMod,aMae,bMae,'MAE Residuals','#74c0fc');
}

function drawRegressionMain(yMod,aMSE,bMSE,aMae,bMae,outMag){
  const c=$('c1'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,270);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const xmn=-3.5,xmx=3.5,ymn=-4,ymx=4;
  axisLabels(ctx,w,h,xmn,xmx,ymn,ymx);
  regX.forEach((xi,i)=>{
    const px=tx(xi,xmn,xmx,w), py=ty(yMod[i],ymn,ymx,h);
    ctx.beginPath(); ctx.arc(px,py,4,0,Math.PI*2);
    ctx.fillStyle=i===regOutIdx?'rgba(255,107,107,0.9)':'rgba(56,217,169,0.7)'; ctx.fill();
    ctx.strokeStyle='rgba(255,255,255,0.15)'; ctx.lineWidth=0.5; ctx.stroke();
  });
  ctx.beginPath(); ctx.strokeStyle='#ff6b6b'; ctx.lineWidth=2;
  ctx.moveTo(tx(xmn,xmn,xmx,w),ty(aMSE+bMSE*xmn,ymn,ymx,h));
  ctx.lineTo(tx(xmx,xmn,xmx,w),ty(aMSE+bMSE*xmx,ymn,ymx,h)); ctx.stroke();
  ctx.beginPath(); ctx.strokeStyle='#74c0fc'; ctx.lineWidth=2; ctx.setLineDash([6,3]);
  ctx.moveTo(tx(xmn,xmn,xmx,w),ty(aMae+bMae*xmn,ymn,ymx,h));
  ctx.lineTo(tx(xmx,xmn,xmx,w),ty(aMae+bMae*xmx,ymn,ymx,h)); ctx.stroke();
  ctx.setLineDash([]);
  ctx.font='9px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText(`Outlier magnitude: ${outMag.toFixed(1)} | Red dot = outlier`,w/2,h-4);
}

function drawResidPanel(c,xs,ys,a,b,label,color){
  if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,100);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const res=xs.map((xi,i)=>ys[i]-(a+b*xi));
  const maxR=Math.max(...res.map(Math.abs))*1.3||1;
  const zy=ty(0,-maxR,maxR,h);
  ctx.strokeStyle='rgba(255,212,59,0.3)'; ctx.lineWidth=1; ctx.setLineDash([3,3]);
  ctx.beginPath(); ctx.moveTo(PAD,zy); ctx.lineTo(w-PAD,zy); ctx.stroke(); ctx.setLineDash([]);
  res.forEach((r,i)=>{
    const px=tx(i,0,xs.length-1,w), py=ty(r,-maxR,maxR,h);
    ctx.beginPath(); ctx.arc(px,py,3,0,Math.PI*2);
    ctx.fillStyle=r>=0?`${color}cc`:'rgba(56,217,169,0.7)'; ctx.fill();
  });
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText(label,w/2,h-4);
}

/* ═══ TAB 2: CLASSIFICATION ═══ */
const CLS_TYPES=['Cross-Entropy','Hinge Loss','Focal Loss'];
const CLS_INSIGHTS=[
  'Cross-Entropy: measures divergence between predicted distribution and true label. Standard for neural networks.',
  'Hinge Loss: used in SVMs. Only penalises predictions within the margin. Zero loss when confident & correct.',
  'Focal Loss: down-weights easy examples (γ=2). Solves class imbalance by focusing on hard negatives.'
];
let activeCls=0;

(function buildClsPills(){
  const row=$('clsRow');
  CLS_TYPES.forEach((l,i)=>{
    const b=document.createElement('button');
    b.className='pill'+(i===0?' on':'');
    b.textContent=l;
    b.onclick=()=>{
      activeCls=i;
      document.querySelectorAll('#clsRow .pill').forEach((x,j)=>x.classList.toggle('on',j===i));
      $('clsInsight').textContent=CLS_INSIGHTS[i];
      updateClassification();
    };
    row.appendChild(b);
  });
})();

function crossEntropy(p,y){return y===1?-Math.log(Math.max(p,1e-7)):-Math.log(Math.max(1-p,1e-7));}
function hingeLoss(p,y){const s=y===1?p:1-p; return Math.max(0,1-s);}
function focalLoss(p,y,gamma=2){const ce=crossEntropy(p,y); const pt=y===1?p:1-p; return Math.pow(1-pt,gamma)*ce;}

function updateClassification(){
  const p=parseFloat($('predPSl').value);
  const y=parseInt($('trueLSl').value);
  $('predPV').textContent=p.toFixed(2);
  $('trueLV').textContent=y;
  $('pLabel').textContent=p.toFixed(2);
  $('yLabel').textContent=y;
  $('ceVal').textContent=crossEntropy(p,y).toFixed(4);
  $('hingeVal').textContent=hingeLoss(p,y).toFixed(4);
  $('focalVal').textContent=focalLoss(p,y).toFixed(4);
  $('accVal').textContent=((y===1&&p>=0.5)||(y===0&&p<0.5))?'Correct':'Wrong';
  drawClassificationMain(p,y);
  drawCECurves(p,y);
  drawProbBar(p,y);
}

function drawClassificationMain(selP,selY){
  const c=$('c2'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,270);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const ps=Array.from({length:200},(_,i)=>0.01+i*0.98/199);
  const vmx=6;
  axisLabels(ctx,w,h,0,1,0,vmx);
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Predicted probability p',w/2,h-4);
  const fns=[p=>crossEntropy(p,selY),p=>hingeLoss(p,selY),p=>focalLoss(p,selY)];
  const colors=['#ff6b6b','#74c0fc','#b197fc'];
  fns.forEach((fn,i)=>{
    ctx.globalAlpha=(activeCls===i)?1:0.25;
    ctx.beginPath(); ctx.strokeStyle=colors[i]; ctx.lineWidth=2;
    ps.forEach((p,j)=>{
      const lv=Math.min(fn(p),vmx);
      const px2=tx(p,0,1,w), py=ty(lv,0,vmx,h);
      j===0?ctx.moveTo(px2,py):ctx.lineTo(px2,py);
    });
    ctx.stroke();
  });
  ctx.globalAlpha=1;
  const ox=tx(selP,0,1,w);
  ctx.strokeStyle='rgba(255,212,59,0.6)'; ctx.lineWidth=1; ctx.setLineDash([4,4]);
  ctx.beginPath(); ctx.moveTo(ox,PAD); ctx.lineTo(ox,h-PAD); ctx.stroke(); ctx.setLineDash([]);
  const names=['Cross-Entropy','Hinge','Focal(γ=2)'];
  let lx=PAD;
  colors.forEach((col,i)=>{
    ctx.fillStyle=col; ctx.fillRect(lx,PAD+10,16,3);
    ctx.fillStyle='#dce4f0'; ctx.font='8px monospace'; ctx.textAlign='left';
    ctx.fillText(names[i],lx+20,PAD+15); lx+=78;
  });
}

function drawCECurves(selP){
  const c=$('c2a'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,100);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const ps=Array.from({length:200},(_,i)=>0.01+i*0.98/199);
  [[1,'#38d9a9'],[0,'#ff6b6b']].forEach(([y,col])=>{
    ctx.beginPath(); ctx.strokeStyle=col; ctx.lineWidth=1.5;
    ps.forEach((p,j)=>{
      const lv=Math.min(crossEntropy(p,y),5);
      const px=tx(p,0,1,w), py=ty(lv,0,5,h);
      j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
    });
    ctx.stroke();
  });
  const ox=tx(selP,0,1,w);
  ctx.strokeStyle='rgba(255,212,59,0.5)'; ctx.lineWidth=1; ctx.setLineDash([3,3]);
  ctx.beginPath(); ctx.moveTo(ox,PAD); ctx.lineTo(ox,h-PAD); ctx.stroke(); ctx.setLineDash([]);
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('CE: green=y1, red=y0',w/2,h-4);
}

function drawProbBar(selP){
  const c=$('c2b'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,100);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const ps=Array.from({length:200},(_,i)=>0.01+i*0.98/199);
  [[0,'#74c0fc'],[1,'#b197fc'],[2,'#ffd43b'],[4,'#ff6b6b']].forEach(([g,col])=>{
    ctx.beginPath(); ctx.strokeStyle=col; ctx.lineWidth=1.5;
    ps.forEach((p,j)=>{
      const lv=Math.min(focalLoss(p,1,g),5);
      const px=tx(p,0,1,w), py=ty(lv,0,5,h);
      j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
    });
    ctx.stroke();
  });
  const ox=tx(selP,0,1,w);
  ctx.strokeStyle='rgba(255,212,59,0.5)'; ctx.lineWidth=1; ctx.setLineDash([3,3]);
  ctx.beginPath(); ctx.moveTo(ox,PAD); ctx.lineTo(ox,h-PAD); ctx.stroke(); ctx.setLineDash([]);
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Focal Loss: γ=0,1,2,4 (y=1)',w/2,h-4);
}

/* ═══ TAB 3: GRADIENT DESCENT ═══ */
function lossFn(t){return 0.3*t*t*t*t - 2*t*t + 0.5*t + 1.5;}
function gradFn(t){return 1.2*t*t*t - 4*t + 0.5;}

let gdTheta=-3, gdVelocity=0, gdHistory=[], gdRunning=false, gdTimer=null;

function resetGD(){
  if(gdTimer){clearInterval(gdTimer);gdTimer=null;gdRunning=false;}
  gdTheta=parseFloat($('thetaSl').value);
  gdVelocity=0; gdHistory=[];
  $('lrV').textContent=parseFloat($('lrSl').value).toFixed(2);
  $('momV').textContent=parseFloat($('momSl').value).toFixed(2);
  $('thetaV').textContent=gdTheta.toFixed(1);
  $('gdEpoch').textContent='0';
  $('gdTheta').textContent=gdTheta.toFixed(4);
  $('gdLoss').textContent=lossFn(gdTheta).toFixed(4);
  $('gdGrad').textContent=gradFn(gdTheta).toFixed(4);
  $('gdLog').innerHTML='Adjusted — ready to run...';
  drawGD(); drawLossHistory();
}

function stepGD(){
  const lr=parseFloat($('lrSl').value);
  const mom=parseFloat($('momSl').value);
  const g=gradFn(gdTheta);
  gdVelocity=mom*gdVelocity+lr*g;
  gdHistory.push({theta:gdTheta,loss:lossFn(gdTheta)});
  gdTheta-=gdVelocity;
  gdTheta=Math.max(-4.5,Math.min(4.5,gdTheta));
  const epoch=gdHistory.length;
  $('gdEpoch').textContent=epoch;
  $('gdTheta').textContent=gdTheta.toFixed(4);
  $('gdLoss').textContent=lossFn(gdTheta).toFixed(4);
  $('gdGrad').textContent=g.toFixed(4);
  const log=$('gdLog');
  const col=lossFn(gdTheta)<1.5?'span class="r"':'span class="w"';
  log.innerHTML+=`<br><${col}>Ep${epoch}</${col.split(' ')[0]}> θ=${gdTheta.toFixed(3)} L=${lossFn(gdTheta).toFixed(3)}`;
  log.scrollTop=log.scrollHeight;
  drawGD(); drawLossHistory();
}

function runGD(){
  if(gdRunning){clearInterval(gdTimer);gdTimer=null;gdRunning=false;return;}
  gdRunning=true;
  gdTimer=setInterval(()=>{
    stepGD();
    if(gdHistory.length>=100||Math.abs(gradFn(gdTheta))<0.0005){
      clearInterval(gdTimer);gdTimer=null;gdRunning=false;
      const log=$('gdLog');
      log.innerHTML+='<br><span>Converged!</span>'; log.scrollTop=log.scrollHeight;
    }
  },100);
}

function drawGD(){
  const c=$('c3'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,270);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const ts=Array.from({length:400},(_,i)=>-4.5+i*9/399);
  const vmn=-1, vmx=8;
  axisLabels(ctx,w,h,-4.5,4.5,vmn,vmx);
  ctx.font='8px monospace'; ctx.fillStyle='#555f80';
  ctx.textAlign='center'; ctx.fillText('Parameter θ',w/2,h-4);
  ctx.textAlign='left'; ctx.fillText('L(θ)',4,PAD-4);
  ctx.beginPath(); ctx.strokeStyle='#38d9a9'; ctx.lineWidth=2;
  ts.forEach((t,j)=>{
    const lv=Math.max(vmn,Math.min(vmx,lossFn(t)));
    const px=tx(t,-4.5,4.5,w), py=ty(lv,vmn,vmx,h);
    j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
  });
  ctx.stroke();
  if(gdHistory.length>1){
    ctx.beginPath(); ctx.strokeStyle='rgba(255,212,59,0.5)'; ctx.lineWidth=1.5;
    gdHistory.forEach((pt,j)=>{
      const px=tx(pt.theta,-4.5,4.5,w), py=ty(Math.max(vmn,Math.min(vmx,pt.loss)),vmn,vmx,h);
      j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
    });
    ctx.stroke();
  }
  const cpx=tx(gdTheta,-4.5,4.5,w), cpy=ty(Math.max(vmn,Math.min(vmx,lossFn(gdTheta))),vmn,vmx,h);
  ctx.beginPath(); ctx.arc(cpx,cpy,6,0,Math.PI*2);
  ctx.fillStyle='#ff6b6b'; ctx.fill();
  ctx.strokeStyle='rgba(255,255,255,0.4)'; ctx.lineWidth=1.5; ctx.stroke();
  const g=gradFn(gdTheta);
  const arrowLen=Math.min(40,Math.abs(g)*10)*Math.sign(g);
  ctx.beginPath(); ctx.strokeStyle='#ff6b6b'; ctx.lineWidth=2;
  ctx.moveTo(cpx,cpy); ctx.lineTo(cpx-arrowLen,cpy); ctx.stroke();
  ctx.fillStyle='#ff6b6b';
  ctx.beginPath();
  ctx.moveTo(cpx-arrowLen-(Math.sign(g)*6),cpy);
  ctx.lineTo(cpx-arrowLen+(Math.sign(g)*5),cpy-4);
  ctx.lineTo(cpx-arrowLen+(Math.sign(g)*5),cpy+4);
  ctx.fill();
  ctx.font='9px monospace'; ctx.fillStyle='#38d9a9'; ctx.textAlign='left';
  ctx.fillText('— L(θ)',PAD,PAD+14);
  ctx.fillStyle='rgba(255,212,59,0.8)'; ctx.fillText('— Path',PAD+48,PAD+14);
}

function drawLossHistory(){
  const c=$('c3b'); if(!c.offsetWidth) return;
  const {ctx,w,h}=initCanvas(c,110);
  ctx.fillStyle='#0b0d12'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  if(gdHistory.length<2){
    ctx.font='9px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
    ctx.fillText('Loss history will appear here after stepping',w/2,h/2); return;
  }
  const losses=gdHistory.map(p=>p.loss);
  const mn2=Math.min(...losses)*0.9, mx2=Math.max(...losses)*1.1;
  axisLabels(ctx,w,h,0,losses.length-1,mn2,mx2);
  ctx.beginPath(); ctx.strokeStyle='#ffd43b'; ctx.lineWidth=2;
  losses.forEach((l,j)=>{
    const px=tx(j,0,losses.length-1,w), py=ty(l,mn2,mx2,h);
    j===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
  });
  ctx.stroke();
  ctx.font='8px monospace'; ctx.fillStyle='#555f80'; ctx.textAlign='center';
  ctx.fillText('Loss over training steps',w/2,h-4);
}

/* ═══ TAB SWITCHING ═══ */
function go(i,btn){
  document.querySelectorAll('.panel').forEach((p,j)=>p.classList.toggle('on',j===i));
  document.querySelectorAll('.tab').forEach((b,j)=>b.classList.toggle('on',j===i));
  if(i===0) setTimeout(()=>updateLandscape(),30);
  if(i===1) setTimeout(()=>updateRegression(),30);
  if(i===2) setTimeout(()=>updateClassification(),30);
  if(i===3) setTimeout(()=>resetGD(),30);
}

/* ═══ INIT ═══ */
window.addEventListener('load',()=>{
  setTimeout(()=>{
    genRegData();
    resetGD();
    updateLandscape();
  },200);
});

window.addEventListener('resize',()=>{
  const idx=[...document.querySelectorAll('.panel')].findIndex(p=>p.classList.contains('on'));
  if(idx===0) updateLandscape();
  if(idx===1) updateRegression();
  if(idx===2) updateClassification();
  if(idx===3){drawGD();drawLossHistory();}
});
</script>
</body>
</html>
