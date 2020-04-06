package com.example.preclarity;

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
import java.net.URL;
import java.net.URLEncoder;

public class PostDescriptionBackgroundWorker extends AsyncTask<Integer, Void, String> {
    Context context;
    public PostDescriptionBackgroundWorker(Context ctx){
        context = ctx;
    }
    @Override
    protected String doInBackground(Integer... integers) {
        Topic topic =null;
        String sujet="";
        Integer idTopic = integers[0];
        String login_url="http://pjs4.ulyssebouchet.fr/Android/TopicDescription.php";
        String result="";
        try {
            URL url = new URL(login_url);
            HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setDoOutput(true);
            httpURLConnection.setDoInput(true);
            OutputStream outputStream = httpURLConnection.getOutputStream();
            BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
            String post_data = URLEncoder.encode("idTopic","UTF-8")+"="+URLEncoder.encode(String.valueOf(idTopic),"UTF-8");
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
            //Log.w(TAG, "Malformated EXCEPTIOOOOOOOON");
        } catch (IOException e) {
            //Log.w(TAG, "IO EXCEPTIOOOOOOOON");
        }

        try {
            String s="";
            JSONArray jArray = new JSONArray(result);
            for(int i =0; i<jArray.length();i++){
                JSONObject json = jArray.getJSONObject(i);
                sujet = json.getString("titre");
               /* String auteur = json.getString("pseudo");
                String photo = json.getString("imageProfil");
                String content = json.getString("content");
                String date = json.getString("dateTopic");
                topic = new Topic(idTopic, sujet, auteur,date, photo, content );
*/
            }
            return sujet;
            // TopicAdapter adapter = new TopicAdapter(context, lastTopics);

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return null;
    }
}
