// Modules to control application life and create native browser window
const {app, BrowserWindow, dialog } = require('electron')
const path = require('path')

function createWindow () {
  // Create the browser window.
  // const loginWindow = new BrowserWindow({
  //   width: 1800,
  //   height: 1000,
  //   webPreferences: {
  //     preload: path.join(__dirname, 'preload.js')
  //   }
  // })

  // const dailyWindow = new BrowserWindow({
  //   width: 1800,
  //   height: 1000,
  //   webPreferences: {
  //     preload: path.join(__dirname, 'preload.js')
  //   }
  // })

  // const manageJobWindow = new BrowserWindow({
  //   width: 1800,
  //   height: 1000,
  //   webPreferences: {
  //     preload: path.join(__dirname, 'preload.js')
  //   }
  // })

  const detailJobWindow = new BrowserWindow({
      width: 1800,
      height: 1000,
      webPreferences: {
        preload: path.join(__dirname, 'preload.js')
      }
    })

  // loginWindow.loadFile('index.html')
  // loginWindow.webContents.openDevTools();

  //dailyWindow.loadFile('daily_report.html')

  //manageJobWindow.loadFile('manage_job.html')

  detailJobWindow.loadFile('detail_job.html')
  
}

// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Some APIs can only be used after this event occurs.
app.whenReady().then(() => {
  createWindow()
  
  app.on('activate', function () {
    // On macOS it's common to re-create a window in the app when the
    // dock icon is clicked and there are no other windows open.
    if (BrowserWindow.getAllWindows().length === 0) createWindow()
  })
})

// function httpGet(theUrl) {
//   var xmlHttp = new XMLHttpRequest();
//   xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
//   xmlHttp.send( null );
//   return xmlHttp.responseText;
// }

// Quit when all windows are closed, except on macOS. There, it's common
// for applications and their menu bar to stay active until the user quits
// explicitly with Cmd + Q.
app.on('window-all-closed', function () {
  if (process.platform !== 'darwin') app.quit()
})

// In this file you can include the rest of your app's specific main process
// code. You can also put them in separate files and require them here.
