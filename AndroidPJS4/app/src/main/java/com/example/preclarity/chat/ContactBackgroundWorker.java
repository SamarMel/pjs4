package com.example.preclarity.chat;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

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
import java.lang.reflect.Array;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;

public class ContactBackgroundWorker extends AsyncTask<Integer, Void, List<String>> {
    private static final String TAG = "CONTACT BW";


    @Override
    protected ArrayList<String> doInBackground(Integer... integers) {
        int idUser = integers[0];
        String pseudo="";
        String photo="";
        String login_url="http://pjs4.ulyssebouchet.fr/Android/Contact.php";
        String result="";

        try {
            URL url = new URL(login_url);
            HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setDoOutput(true);
            httpURLConnection.setDoInput(true);
            OutputStream outputStream = httpURLConnection.getOutputStream();
            BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
            String post_data = URLEncoder.encode("idUser","UTF-8")+"="+URLEncoder.encode(String.valueOf(idUser),"UTF-8");
            bufferedWriter.write(post_data);
            bufferedWriter.flush();
            bufferedWriter.close();
            outputStream.close();
            InputStream inputStream = httpURLConnection.getInputStream();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
            // String result="";
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
            Log.w(TAG, result);
            String s="";
            List info = new ArrayList<String>();
            JSONArray jArray = new JSONArray(result);
            for(int i =0; i<jArray.length();i++){
                JSONObject json = jArray.getJSONObject(i);
                 pseudo = json.getString("pseudo");
                 photo = json.getString("imageProfil");
                 info.add(pseudo);
                 info.add(photo);

            }

            return (ArrayList<String>) info;


        } catch (JSONException e) {
            e.printStackTrace();
        }


        return null;
    }
}
