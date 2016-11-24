$( pieChart );
function pieChart() {

  // 配置
  var chartSizePercent = 55;                        // 图表半径相对于画布宽度/高度（百分比）
  var sliceBorderWidth = 1;                         // 每片边框的宽度（像素）
  var sliceBorderStyle = "#fff";                    // 每片边缘的颜色
  var sliceGradientColour = "#ddd";                 // 用于图表梯度的一个结束的颜色
  var maxPullOutDistance = 25;                      // 像素，以像素为单位，点击时将被拉出
  var pullOutFrameStep = 4;                         // 每一个动画帧中移动一个片的像素有多少个
  var pullOutFrameInterval = 40;                    // 每一个动画帧之间有多长（在毫秒内）
  var pullOutLabelPadding = 65;                     // 拉出片与它的标签之间的填充物  
  var pullOutLabelFont = "bold 16px 'Trebuchet MS', Verdana, sans-serif";   
  var pullOutValueFont = "bold 12px 'Trebuchet MS', Verdana, sans-serif";  
  var pullOutValuePrefix = "▶";                     // 拉出值前缀
  var pullOutShadowColour = "rgba( 0, 0, 0, .5 )";  // 颜色使用拔片的影子
  var pullOutShadowOffsetX = 5;                     // X轴方向偏移（像素）的拔出片的影子
  var pullOutShadowOffsetY = 5;                     // 偏移量（以像素为单位）的拔出片的影子
  var pullOutShadowBlur = 5;                        // 多少模糊的影子拉片
  var pullOutBorderWidth = 2;                       // 宽度（像素）的拔片边界
  var pullOutBorderStyle = "#333";                  // 拔出片的边框颜色
  var chartStartAngle = -.5 * Math.PI;              // 在十二点而不是三点开始图表

  // 声明图表的一些变量
  var canvas;                       // 页面中的画布元素
  var currentPullOutSlice = -1;     // 他目前的切片（(-1 = no slice）
  var currentPullOutDistance = 0;   //当前正在退出的动画中有多少像素的像素
  var animationId = 0;              // 轨道由setinterval()动画间隔的ID
  var chartData = [];               // 图表数据（标签、值和角度）
  var chartColours = [];            // 图的颜色（从HTML表格拉）
  var totalValue = 0;               // 图表中所有的值的总数
  var canvasWidth;                  // 画布宽度，以像素为单位
  var canvasHeight;                 // 画布的高度，以像素为单位
  var centreX;                      // 画布中心x轴坐标/图表
  var centreY;                      // 画布中心y轴坐标/图表
  var chartRadius;                  // 半径的饼图，像素
  // 设置和绘制图表
  init();

  /**
   * 设置图表数据和颜色，以及图表和表中的单击处理程序，并绘
   * 制初始的饼图
   */

  function init() {

    // 获取页面中的画布元素
    canvas = document.getElementById('chart');

    // 退出，如果浏览器是不是画布上的能力
    if ( typeof canvas.getContext === 'undefined' ) return;

    // 初始化的帆布和图的一些性质
    canvasWidth = canvas.width;
    canvasHeight = canvas.height;
    centreX = canvasWidth / 2;
    centreY = canvasHeight / 2;
    chartRadius = Math.min( canvasWidth, canvasHeight ) / 2 * ( chartSizePercent / 100 );

    // 从表中抓取数据，并将单击处理程序分配给表数据单元
    
    var currentRow = -1;
    var currentCell = 0;

    $('#chartData td').each( function() {
      currentCell++;
      if ( currentCell % 2 != 0 ) {
        currentRow++;
        chartData[currentRow] = [];
        chartData[currentRow]['label'] = $(this).text();
      } else {
       var value = parseFloat($(this).text());
       totalValue += value;
       value = value.toFixed(2);
       chartData[currentRow]['value'] = value;
      }

      // 将该切片索引存储在该单元格中，并将其附加到它的单击处理程序
      $(this).data( 'slice', currentRow );
      $(this).click( handleTableClick );

      // 提取和储存细胞的颜色
      if ( rgb = $(this).css('color').match( /rgb\((\d+), (\d+), (\d+)/) ) {
        chartColours[currentRow] = [ rgb[1], rgb[2], rgb[3] ];
      } else if ( hex = $(this).css('color').match(/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/) ) {
        chartColours[currentRow] = [ parseInt(hex[1],16) ,parseInt(hex[2],16), parseInt(hex[3], 16) ];
      } else {
        alert( "Error: Colour could not be determined! Please specify table colours using the format '#xxxxxx'" );
        return;
      }

    } );

    // 现在计算和存储图表数据中的每一个切片的开始和结束的角度

    var currentPos = 0; //当前位置的切片在饼（从0到1）
    for ( var slice in chartData ) {
      chartData[slice]['startAngle'] = 2 * Math.PI * currentPos;
      chartData[slice]['endAngle'] = 2 * Math.PI * ( currentPos + ( chartData[slice]['value'] / totalValue ) );
      currentPos += chartData[slice]['value'] / totalValue;
    }

    // 都准备好了！现在绘制饼图，并添加单击处理程序
    drawChart();
    $('#chart').click ( handleChartClick );
  }


  /**
   * 进程鼠标单击图表区域中的鼠标。
   *
   * 如果一个切片被点击，切换或退出.
   * 如果用户点击了外面的馅饼，推任何片。
   */

  function handleChartClick ( clickEvent ) {

    // 获取鼠标光标在单击鼠标的时间位置，相对于画布
    var mouseX = clickEvent.pageX - this.offsetLeft;
    var mouseY = clickEvent.pageY - this.offsetTop;

    // 点击饼图在什么位置
    var xFromCentre = mouseX - centreX;
    var yFromCentre = mouseY - centreY;
    var distanceFromCentre = Math.sqrt( Math.pow( Math.abs( xFromCentre ), 2 ) + Math.pow( Math.abs( yFromCentre ), 2 ) );

    if ( distanceFromCentre <= chartRadius ) {

      // 单击“图表”中的“单击”，找到通过比较相对于图表中心的角度来单击的部分。

      var clickAngle = Math.atan2( yFromCentre, xFromCentre ) - chartStartAngle;
      if ( clickAngle < 0 ) clickAngle = 2 * Math.PI + clickAngle;
                  
      for ( var slice in chartData ) {
        if ( clickAngle >= chartData[slice]['startAngle'] && clickAngle <= chartData[slice]['endAngle'] ) {

          // 切片发现。按要求拔出或按其所需的。
          toggleSlice ( slice );
          return;
        }
      }
    }

    // 用户必须点击了外面的馅饼。将任何拉出的切片。
    pushIn();
  }


  /**
   * 进程鼠标单击表区域中的鼠标。
   */

  function handleTableClick ( clickEvent ) {
    var slice = $(this).data('slice');
    toggleSlice ( slice );
  }


  /**
   * 推片或出。
   *
   * 如果它已经拔出来，把它推到。否则，把它拔出来。
   *
   * @参数数片指数（0和1之间的数片）
   */

  function toggleSlice ( slice ) {
    if ( slice == currentPullOutSlice ) {
      pushIn();
    } else {
      startPullOut ( slice );
    }
  }

 
  /**
   * 开始从馅饼中拔出一片。
   *
   * @参数数片指数（0和1之间的数片）
   */

  function startPullOut ( slice ) {

    // 退出，如果我们已经退出了这片
    if ( currentPullOutSlice == slice ) return;

    // 记录我们退出的切片，清除任何以前的动画，然后开始动画
    currentPullOutSlice = slice;
    currentPullOutDistance = 0;
    clearInterval( animationId );
    animationId = setInterval( function() { animatePullOut( slice ); }, pullOutFrameInterval );

    // 突出键表中的相应行
    $('#chartData td').removeClass('highlight');
    var labelCell = $('#chartData td:eq(' + (slice*2) + ')');
    var valueCell = $('#chartData td:eq(' + (slice*2+1) + ')');
    labelCell.addClass('highlight');
    valueCell.addClass('highlight');
  }

 
  /**
   * 绘制一个拔出动画帧。
   *
   * @参数数量的层被拉出的指数
   */

  function animatePullOut ( slice ) {

    // 将切片拉出一些
    currentPullOutDistance += pullOutFrameStep;

    // 如果我们将它从右侧拉出，退出动画
    if ( currentPullOutDistance >= maxPullOutDistance ) {
      clearInterval( animationId );
      return;
    }

    // 绘制框架
    drawChart();
  }

 
  /**
   * 将任何拉出的切片。
   *
   * 重置动画变量和绘图。
   */

  function pushIn() {
    currentPullOutSlice = -1;
    currentPullOutDistance = 0;
    clearInterval( animationId );
    drawChart();
    $('#chartData td').removeClass('highlight');
  }
 
 
  /**
   * 绘制图表。
   *
   * 通过每一块馅饼循环，并绘制它
   */

  function drawChart() {

    // 获取绘图上下文
    var context = canvas.getContext('2d');
        
    // 清除画布，准备新的框架
    context.clearRect ( 0, 0, canvasWidth, canvasHeight );

    // 画出每一片图，跳绳拉片（如果有的话)
    for ( var slice in chartData ) {
      if ( slice != currentPullOutSlice ) drawSlice( context, slice );
    }

    // 如果有一个拔出片效果，绘制
    // 我们得出拉拔片上的阴影不会画了
    if ( currentPullOutSlice != -1 ) drawSlice( context, currentPullOutSlice );
  }


  /**
   * 在图表中绘制一个单独的部分。
   *
   * @上下文语境参数帆布画
   * @参数数量的层画指数
   */

  function drawSlice ( context, slice ) {

    // 计算切片的调整后的开始和结束角
    var startAngle = chartData[slice]['startAngle']  + chartStartAngle;
    var endAngle = chartData[slice]['endAngle']  + chartStartAngle;
      
    if ( slice == currentPullOutSlice ) {

      // 我们正在拉（或拉）这片。 从饼中心偏移它，绘制文本标签，
 
      var midAngle = (startAngle + endAngle) / 2;
      var actualPullOutDistance = currentPullOutDistance * easeOut( currentPullOutDistance/maxPullOutDistance, .8 );
      startX = centreX + Math.cos(midAngle) * actualPullOutDistance;
      startY = centreY + Math.sin(midAngle) * actualPullOutDistance;
      context.fillStyle = 'rgb(' + chartColours[slice].join(',') + ')';
      context.textAlign = "center";
      context.font = pullOutLabelFont;
      context.fillText( chartData[slice]['label'], centreX + Math.cos(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ), centreY + Math.sin(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ) );
      context.font = pullOutValueFont;
      context.fillText( pullOutValuePrefix + chartData[slice]['value'] + " (" + ( parseInt( chartData[slice]['value'] / totalValue * 100 + .5 ) ) +  "%)", centreX + Math.cos(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ), centreY + Math.sin(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ) + 20 );
      context.shadowOffsetX = pullOutShadowOffsetX;
      context.shadowOffsetY = pullOutShadowOffsetY;
      context.shadowBlur = pullOutShadowBlur;

    } else {

      // 这片没有拔出来，所以从馅饼中心把它画出来
      startX = centreX;
      startY = centreY;
    }

    // 设置切片的梯度填充
    var sliceGradient = context.createLinearGradient( 0, 0, canvasWidth*.75, canvasHeight*.75 );
    sliceGradient.addColorStop( 0, sliceGradientColour );
    sliceGradient.addColorStop( 1, 'rgb(' + chartColours[slice].join(',') + ')' );

    // 绘制切片
    context.beginPath();
    context.moveTo( startX, startY );
    context.arc( startX, startY, chartRadius, startAngle, endAngle, false );
    context.lineTo( startX, startY );
    context.closePath();
    context.fillStyle = sliceGradient;
    context.shadowColor = ( slice == currentPullOutSlice ) ? pullOutShadowColour : "rgba( 0, 0, 0, 0 )";
    context.fill();
    context.shadowColor = "rgba( 0, 0, 0, 0 )";

    // 适当地将切片边界
    if ( slice == currentPullOutSlice ) {
      context.lineWidth = pullOutBorderWidth;
      context.strokeStyle = pullOutBorderStyle;
    } else {
      context.lineWidth = sliceBorderWidth;
      context.strokeStyle = sliceBorderStyle;
    }

    // 绘制切片边界
    context.stroke();
  }


  /**
   * 宽松的功能。
   *
   * @参数的数量目前的距离比到最大距离
   * @参数数量的功率（高数=逐渐宽松）
   * @返回数新比
   */

  function easeOut( ratio, power ) {
    return ( Math.pow ( 1 - ratio, power ) + 1 );
  }

};