package com.example.preclarity.login;

import android.app.AlertDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import com.example.preclarity.Forum.Topic;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import java.net.URLEncoder;

public class BackgroundWorker extends AsyncTask<String, Void, Integer> {
    private static final String TAG = "3168";
    private Context context;
    private AlertDialog alertDialog;
    BackgroundWorker (Context cxt){
        context = cxt;
    }


    @Override
    protected Integer doInBackground(String... params) {
        String type = params[0];
        String result="";
        int id = -1;
        String login_url="http://pjs4.ulyssebouchet.fr/Android/Identification.php";
        if(type.equals("login")){
            try {
                String user_name = params[1];
                String password = params[2];
                URL url = new URL(login_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                String post_data = URLEncoder.encode("login","UTF-8")+"="+URLEncoder.encode(user_name,"UTF-8")+"&"
                        +URLEncoder.encode("password","UTF-8")+"="+URLEncoder.encode(password,"UTF-8");
                bufferedWriter.write(post_data);
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
              //  String result="";
                String line="";
                while((line = bufferedReader.readLine())!= null) {
                    result += line;
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();
            } catch (MalformedURLException e) {
                Log.w(TAG, "Malformated EXCEPTIOOOOOOOON");
            } catch (IOException e) {
                Log.w(TAG, "IO EXCEPTIOOOOOOOON");
            }

            try {
                String s="";
                JSONArray jArray = new JSONArray(result);
                for(int i =0; i<jArray.length();i++){
                    JSONObject json = jArray.getJSONObject(i);
                     id = json.getInt("id");
                     Log.w("LOGIN USER", String.valueOf(id));
                }
                Log.w("LOGIN USER", String.valueOf(id));
                return id;

            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
        return id;
    }

}
