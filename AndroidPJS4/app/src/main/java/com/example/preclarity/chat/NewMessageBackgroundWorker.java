package com.example.preclarity.chat;

import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

public class NewMessageBackgroundWorker extends AsyncTask<String, Void, Boolean> {
    private static final String TAG = "NEW_MESS_BW";

    @Override
    protected Boolean doInBackground(String... strings) {
        String idConv = strings[0];
        String idAuteur = strings[1];
        String content = strings[2];
        String result="";
        String login_url="http://pjs4.ulyssebouchet.fr/Android/NewMessage.php";

        try {
            URL url = new URL(login_url);
            HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setDoOutput(true);
            httpURLConnection.setDoInput(true);
            OutputStream outputStream = httpURLConnection.getOutputStream();
            BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
            String post_data = URLEncoder.encode("idConv","UTF-8")+"="+URLEncoder.encode(idConv,"UTF-8")+"&"
                    +URLEncoder.encode("idAuteur","UTF-8")+"="+URLEncoder.encode(idAuteur,"UTF-8")+"&"
                    +URLEncoder.encode("content","UTF-8")+"="+URLEncoder.encode(content,"UTF-8");
            bufferedWriter.write(post_data);
            bufferedWriter.flush();
            bufferedWriter.close();
            outputStream.close();
            InputStream inputStream = httpURLConnection.getInputStream();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
            String line="";
            while((line = bufferedReader.readLine())!= null) {
                result += line;
            }
            bufferedReader.close();
            inputStream.close();
            httpURLConnection.disconnect();
            Log.w(TAG, result + "------------------");
            if(result.equals("success")) return true;
            else{
                Log.w("COMMent:", result);
                return false;
            }
        } catch (MalformedURLException e) {
            Log.w("Comment", "Malformated EXCEPTIOOOOOOOON");
        } catch (IOException e) {
            Log.w("Comment", "IO EXCEPTIOOOOOOOON");
        }
        return false;
    }
}
