const fs = require('fs');
const path = require('path');
const {PCA} = require('ml-pca');


let all_files=[];

function parseAllFiles(dirPath) {
    let dirContent=fs.readdirSync(dirPath);
    dirContent.sort(function(a,b){
        let int_a=parseInt(a);
        let int_b=parseInt(b);
        if (int_a<int_b) return -1;
        else if(int_a>int_b) return 1;
        else return 0;
    });
    for(let i=0;i<dirContent.length;i++){
        let filepath=path.join(dirPath,dirContent[i]);
        let stat=fs.statSync(filepath);
        if(stat.isDirectory()){
            parseAllFiles(filepath);
        } else{
            if(dirContent.length<24){
                break;
            }
            if (!filepath.includes("encoded")) continue;
            if (dirContent.length/3-i>=8) all_files.push([]);
            for(let j=all_files.length-1;j>=all_files.length-8 && j>=0;j--){
                if (all_files[j].length==8) break;
                all_files[j].push(filepath);
            }
        }
    }
}

function getRandomSubarray(arr, size) {
    var shuffled = arr.slice(0), i = arr.length, temp, index;
    while (i--) {
        index = Math.floor((i + 1) * Math.random());
        temp = shuffled[index];
        shuffled[index] = shuffled[i];
        shuffled[i] = temp;
    }
    return shuffled.slice(0, size);
}

function load_files(samples){
    let result=[]
    for(let s=0;s<samples.length;s++){
        result.push([]);
        for(let f=0;f<samples[s].length;f++){
            let filename=samples[s][f];
            result[s].push((""+fs.readFileSync(filename)).split(" ").map(function(item){
                return parseFloat(item);
            }));

        }
    }
    return result;
}

parseAllFiles("D:\\splits\\")

let training_array=getRandomSubarray(all_files,3200);
let pca_data=load_files(training_array);
const PCABrain=new PCA(pca_data, {isCovarianceMatrix: false, center: false, scale: false});
fs.writeFileSync("PCAbrain.json",JSON.stringify(PCABrain.toJSON()));
console.log("Hello, world!");
