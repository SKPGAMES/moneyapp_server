public IEnumerator SaveWithdrawalPHP(string userId, int amount, string method, string account)
{
    WWWForm form = new WWWForm();
    form.AddField("user_id", userId);
    form.AddField("amount", amount);
    form.AddField("method", method);
    form.AddField("account", account);

    using (UnityEngine.Networking.UnityWebRequest www = UnityEngine.Networking.UnityWebRequest.Post("https://yourserver.com/withdraw.php", form))
    {
        yield return www.SendWebRequest();

        if (www.result == UnityEngine.Networking.UnityWebRequest.Result.Success)
        {
            Debug.Log("✅ Withdrawal saved to server: " + www.downloadHandler.text);
        }
        else
        {
            Debug.LogError("❌ Server error: " + www.error);
        }
    }
}
